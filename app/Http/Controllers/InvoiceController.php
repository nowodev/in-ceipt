<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\InvoiceDetails;
use App\Jobs\SendInvoiceMailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(10);

        return inertia('Backend/Invoice/Index', [
            'invoices' => $invoices,
        ]);
    }

    public function create()
    {
        $fullname = Request::get('fullname');
        $customers = Customer::get();
        $selected_customer = '';
        if (!empty($fullname)) {
            $selected_customer = Customer::whereFullname($fullname)->first();
        }

        return inertia('Backend/Invoice/Create', [
            'customers' => fn() => $customers,
            'selected_customer' => fn() => $selected_customer
        ]);
    }

    public function store(StoreInvoiceRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $request->validated();

            $user = auth()->user();

            $customer = $user?->customers()->updateOrCreate(
                ['fullname' => $request['fullname']],
                [
                    'fullname' => $request['fullname'],
                    'number' => $request['number'],
                    'email' => $request['email'],
                    'address_1' => $request['address_1'],
                    'address_2' => $request['address_2'],
                ]
            );

            $invoice = Invoice::create([
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
                'serial_no' => $request['serial_no'],
                'issue_date' => $request['issue_date'],
                'due_date' => $request['due_date'],
                'sum_total' => $request['sum_total'],
                'discount' => $request['discount'],
                'sub_total' => $request['sub_total'],
            ]);

            // insert array of product information into the invoice_details table
            foreach ($request['info'] as $info) {
                $invoice->invoice_details()->create([
                    'description' => $info['description'],
                    'unit_price' => $info['unit_price'],
                    'quantity' => $info['quantity'],
                    'total' => $info['total'],
                ]);
            }
        });

        return redirect()->route('invoice.index')->banner('Invoice Created');
    }

    public function show($id)
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
            'issue_date' => $cred['issue_date'],
            'due_date' => $cred['due_date'],
            'sum_total' => $cred['sum_total'],
            'discount' => $cred['discount'],
            'sub_total' => $cred['sub_total'],
        ]);

        // insert array of product information into the invoice_details table
        foreach ($cred['info'] as $info) {
            // BUG FIX: when updating using 'update', it replaces all fields to have the same value
            //          but when using 'createOrUpdate', it adds new values
            $invoice->invoice_details()->updateOrCreate(
                ['description' => $info['description']],
                [
                    'description' => $info['description'],
                    'unit_price' => $info['unit_price'],
                    'quantity' => $info['quantity'],
                    'total' => $info['total'],
                ]
            );
        }

        return redirect()->route('invoice.index')->banner('Invoice Updated');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->invoice_details()->delete();
        $invoice->delete();

        return redirect()->route('invoice.index')->banner('Invoice Deleted');
    }

    // removing a description field (fieldset) from the db
    public function delete_info($desc): RedirectResponse
    {
        $invoice_details = InvoiceDetails::where('description', $desc)->first();
        $invoice_details?->delete();

        return redirect()->back()->banner('Description Removed');
    }

    public function send_mail(Invoice $invoice): RedirectResponse
    {
        $invoice->with('customer')->firstOrFail();

        $user = $invoice->customer->email;

        SendInvoiceMailJob::dispatchAfterResponse($user, $invoice);

//        return new InvoiceCreatedMail($invoice);
        return back()->banner("Invoice Sent to Customer's Mail");
    }
}
