<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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


        dd($request);


        return Redirect::route('invoice.index');
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
