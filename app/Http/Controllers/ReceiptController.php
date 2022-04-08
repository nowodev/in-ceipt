<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Receipt;
use App\Models\Customer;
use Inertia\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
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
     * @param StoreReceiptRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReceiptRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $request->validated();

            $customer = auth()->user()?->customers()->updateOrCreate(
                ['fullname' => $request['fullname']],
                [
                    'number' => $request['number'],
                    'email' => $request['email'],
                    'address_1' => $request['address_1'],
                    'address_2' => $request['address_2'],
                ]
            );

            $receipt = Receipt::create([
                'user_id' => auth()->id(),
                'customer_id' => $customer->id,
                'serial_no' => $request['serial_no'],
                'issue_date' => $request['issue_date'],
                'payment_method' => $request['payment_method']['label'],
                'sum_total' => $request['sum_total'],
                'discount' => $request['discount'],
                'sub_total' => $request['sub_total'],
            ]);

            // insert array of product information into the invoice_details table
            foreach ($request['info'] as $info) {
                $receipt->receipt_details()->create([
                    'description' => $info['description'],
                    'unit_price' => $info['unit_price'],
                    'quantity' => $info['quantity'],
                    'total' => $info['total'],
                ]);
            }
        });

        return redirect()->route('receipt.index')->banner('Receipt Created');
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
