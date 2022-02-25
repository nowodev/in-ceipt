<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);

        return inertia('Backend/Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        return inertia('Backend/Customers/Create');
    }

    public function store(StoreCustomerRequest $request)
    {
        DB::transaction(function () use ($request) {

            $request->validated();

            $user = auth()->user();

            $user?->customers()->create([
                'fullname' => $request['fullname'],
                'number' => $request['number'],
                'email' => $request['email'],
                'address_1' => $request['address_1'],
                'address_2' => $request['address_2'],
            ]);

//            return Redirect::route('customers.index')->banner('Customer Added');
        });

        return redirect()->route('customers.index')->banner('Customer Added');
    }

    public function show($id)
    {
        $customer = Customer::with('invoices')->find($id);

        return inertia('Backend/Customers/Show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCustomerRequest $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->invoices()->delete();
        $customer->delete();

        return Redirect::route('customers.index')->banner('Invoice Deleted');
    }
}
