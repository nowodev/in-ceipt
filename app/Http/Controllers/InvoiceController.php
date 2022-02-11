<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
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
