<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    public function index()
    {
        return inertia('Backend/Invoice/Index');
    }

    public function create()
    {
        return inertia('Backend/Invoice/Create');
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
                'serial_no' => ['required', 'integer', 'max:255'], //optional
                'issue_date' => ['required', 'date'],
                'due_date' => ['required', 'date'],
                'description' => ['required', 'string', 'max:255'],
                'unit_price' => ['required', 'integer'],
                'quantity' => ['required', 'integer'],
                'sub_total' => ['required', 'integer'],
                'discount' => ['required', 'integer'],
                'total' => ['required', 'integer'],
            ]);

            $user = auth()->user();

            $customer = $user?->customers()->create([
                'fullname' => $request['fullname'],
                'number' => $request['number'],
                'email' => $request['email'],
                'address_1' => $request['address_1'],
                'address_2' => $request['address_2'],
            ]);

            $invoice = Invoice::create([
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
                'serial_no' => $request['serial_no'],
                'issue_date' => $request['issue_date'],
                'due_date' => $request['due_date'],
            ]);

            $invoice->invoice_details()->create([
                'description' => $request['description'],
                'unit_price' => $request['unit_price'],
                'quantity' => $request['quantity'],
                'sub_total' => $request['sub_total'],
                'discount' => $request['discount'],
                'total' => $request['total'],
            ]);
        });

        return Redirect::route('invoice.index')->banner('Invoice Created');
    }

    public function show(Invoice $invoice)
    {
        //
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
        //
    }
}
