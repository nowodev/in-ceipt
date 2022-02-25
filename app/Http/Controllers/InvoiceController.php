<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreInvoiceRequest;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::get();

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

        return Redirect::route('invoice.index')->banner('Invoice Created');
    }

    public function show($id)
    {
        $invoice = Invoice::with('customer', 'invoice_details')->find($id);

        return inertia('Backend/Invoice/Show', [
            'invoice' => $invoice,
        ]);
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->invoice_details()->delete();
        $invoice->delete();

        return Redirect::route('invoice.index')->banner('Invoice Deleted');
    }

    // removing a description field (fieldset) from the db
    public function delete_info($desc): RedirectResponse
    {
        $invoice_details = InvoiceDetails::where('description', $desc)->first();
        $invoice_details->delete();

        return redirect()->back()->banner('Description Removed');
    }
}
