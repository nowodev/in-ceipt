<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::authUser()->paginate(10);

        return inertia('Backend/Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        return inertia('Backend/Customers/Create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
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

    public function edit(Customer $customer)
    {
        return inertia('Backend/Customers/Edit', [
            'customer' => $customer
        ]);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')->banner('Customer Updated');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->invoices()->delete();
        $customer->delete();

        return redirect()->route('customers.index')->banner('Customer Deleted');
    }
}
