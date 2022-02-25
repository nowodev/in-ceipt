<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function store(): RedirectResponse
    {
        DB::transaction(function () {

            $request = Request::validate([
                'fullname' => ['required', 'string'],
                'number' => ['sometimes', 'nullable', 'min:11'],
                'email' => ['nullable', 'email', 'max:255'],
                'address_1' => ['string', 'sometimes', 'nullable', 'max:255'],
                'address_2' => ['string', 'sometimes', 'nullable', 'max:255'],
                'serial_no' => ['required', 'integer', 'digits_between:7,14'], //optional
                'issue_date' => ['required', 'date'],
                'due_date' => ['required', 'date'],
                'info.*.description' => ['required', 'string', 'max:255'],
                'info.*.unit_price' => ['required', 'numeric'],
                'info.*.quantity' => ['required', 'integer'],
                'info.*.total' => ['required', 'numeric'],
                'sum_total' => ['required', 'numeric'],
                'discount' => ['required', 'integer'],
                'sub_total' => ['required', 'numeric'],
            ], [
                'info.*.description.required' => 'The description is required',
                'info.*.unit_price.required' => 'The unit price is required',
                'info.*.quantity.required' => 'The quantity is required',
                'info.*.total.required' => 'The total is required',
            ]);

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
}
