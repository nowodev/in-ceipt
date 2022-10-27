<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Invoice;
use App\Models\Customer;
use Inertia\ResponseFactory;
use App\Models\InvoiceDetails;
use App\Jobs\SendInvoiceMailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $invoices = Invoice::authUser()->with('customer')->paginate(10);

        return inertia('Backend/Invoice/Index', [
            'invoices' => $invoices,
        ]);
    }

    public function create(): Response|ResponseFactory
    {
        $customer_id = Request::get('customer_id');
        $selected_customer = '';

        if (!empty($customer_id)) {
            $selected_customer = Customer::findOrFail($customer_id);
        }

        return inertia('Backend/Invoice/Create', [
            'customer_id' => Request::get('customer_id'),
            'customers' => Customer::orderBy('id', 'DESC')
                ->get()
                ->transform(function ($customers) {
                    return [
                        'id'    => $customers->id,
                        'label' => $customers->fullname,
                    ];
                }),
            'selected_customer' => fn () => $selected_customer
        ]);
    }

    public function store(StoreInvoiceRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $request->validated();

            $customer = auth()->user()?->customers()->updateOrCreate(
                [
                    'fullname'   => data_get($request, 'fullname'),
                ],
                [
                    'number'    => data_get($request, 'number'),
                    'email'     => data_get($request, 'email'),
                    'address_1' => data_get($request, 'address_1'),
                    'address_2' => data_get($request, 'address_2'),
                ]
            );

            $invoice = Invoice::create([
                'user_id'     => auth()->id(),
                'customer_id' => $customer->id,
                'serial_no'   => data_get($request, 'serial_no'),
                'issue_date'  => data_get($request, 'issue_date'),
                'due_date'    => data_get($request, 'due_date'),
                'sum_total'   => data_get($request, 'sum_total'),
                'discount'    => data_get($request, 'discount'),
                'sub_total'   => data_get($request, 'sub_total'),
            ]);

            // insert array of product information into the invoice_details table
            foreach ($request['info'] as $info) {
                $invoice->invoice_details()->create([
                    'description' => data_get($info, 'description'),
                    'unit_price'  => data_get($info, 'unit_price'),
                    'quantity'    => data_get($info, 'quantity'),
                    'total'       => data_get($info, 'total'),
                ]);
            }
        });

        return redirect()->route('invoice.index')->banner('Invoice Created');
    }

    public function show($id): Response|ResponseFactory
    {
        $invoice = Invoice::with('customer', 'invoice_details')->find($id);

        return inertia('Backend/Invoice/Show', [
            'invoice' => $invoice,
        ]);
    }

    public function edit($id)
    {
        $invoice = Invoice::with('customer', 'invoice_details')->find($id);

        return inertia('Backend/Invoice/Edit', [
            'invoice' => $invoice
        ]);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $cred = $request->validated();

        $invoice->update([
            'issue_date' => data_get($cred, 'issue_date'),
            'due_date'   => data_get($cred, 'due_date'),
            'sum_total'  => data_get($cred, 'sum_total'),
            'discount'   => data_get($cred, 'discount'),
            'sub_total'  => data_get($cred, 'sub_total'),
        ]);

        // insert array of product information into the invoice_details table
        collect($cred['info'])->each(function (array $row) use ($invoice) {

            $invoice->invoice_details()->updateOrCreate(
                [
                    'id' => data_get($row, 'invoice_details_id'),
                ],
                [
                    'description' => data_get($row, 'description'),
                    'unit_price'  => data_get($row, 'unit_price'),
                    'quantity'    => data_get($row, 'quantity'),
                    'total'       => data_get($row, 'total'),
                ]
            );
        });

        return redirect()->route('invoice.index')->banner('Invoice Updated');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->invoice_details()->delete();
        $invoice->delete();

        return redirect()->route('invoice.index')->banner('Invoice Deleted');
    }

    // removing a description field (fieldset) from the db
    public function deleteInfo($desc): RedirectResponse
    {
        $invoice_details = InvoiceDetails::where('description', $desc)->first();
        $invoice_details?->delete();

        return redirect()->back()->banner('Description Removed');
    }

    public function sendMail($id): RedirectResponse
    {
        $invoice = Invoice::with('user', 'customer')->findOrFail($id);
        $user = $invoice->customer->email;

        SendInvoiceMailJob::dispatch($user, $invoice);

        // return new InvoiceCreatedMail($invoice);
        return back()->banner("Invoice Sent to Customer's Mail");
    }
}
