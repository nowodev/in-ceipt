<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Receipt;
use App\Models\Customer;
use Inertia\ResponseFactory;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        $receipts = Receipt::authUser()->with('customer')->paginate(10);

        return inertia('Backend/Receipt/Index', [
            'receipts' => $receipts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create()
    {
        $customer_id = Request::get('customer_id');
        $selected_customer = '';

        if (!empty($customer_id)) {
            $selected_customer = Customer::findOrFail($customer_id);
        }

        return inertia('Backend/Receipt/Create', [
            'customer_id' => Request::get('customer_id'),
            'customers' => Customer::orderBy('id', 'DESC')
                ->get()
                ->transform(function ($customers) {
                    return [
                        'id' => $customers->id,
                        'label' => $customers->fullname,
                    ];
                }),
            'selected_customer' => fn() => $selected_customer
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreReceiptRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateReceiptRequest $request
     * @param \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
