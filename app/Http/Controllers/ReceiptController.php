<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Receipt;
use App\Models\Customer;
use Inertia\ResponseFactory;
use App\Models\ReceiptDetails;
use App\Jobs\SendInvoiceMailJob;
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
     * @param $id
     * @return Response|ResponseFactory
     */
    public function show($id)
    {
        $receipt = Receipt::query()->with('customer', 'receipt_details')->find($id);

        return inertia('Backend/Receipt/Show', [
            'receipt' => $receipt,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response|ResponseFactory
     */
    public function edit($id)
    {
        $receipt = Receipt::with('customer', 'receipt_details')->find($id);

        return inertia('Backend/Receipt/Edit', [
            'receipt' => $receipt
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReceiptRequest $request
     * @param Receipt $receipt
     * @return RedirectResponse
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt): RedirectResponse
    {
        $cred = $request->validated();

        $receipt->update([
            'issue_date' => $cred['issue_date'],

            // check if payment_method is an array. It will be a string if the payment method value isn't edited
            'payment_method' => !is_array($cred['payment_method']) ? $cred['payment_method'] : $cred['payment_method']['label'],
            'sum_total' => $cred['sum_total'],
            'discount' => $cred['discount'],
            'sub_total' => $cred['sub_total'],
        ]);

        // insert array of product information into the invoice_details table

        // BUG TO FIX (FUTURE FEATURE)
        // Currently disable adding new description. Data can only be updated, no insertion for now.
        collect($cred['info'])->each(function (array $row) use ($receipt) {
            $receipt->receipt_details()
//                ->where('id', $row['invoice_details_id'])
//                ->orWhere('unit_price', $row['unit_price'])
                ->updateOrCreate(
                    ['id' => $row['receipt_details_id'],],
                    [
                        'description' => $row['description'],
                        'unit_price' => $row['unit_price'],
                        'quantity' => $row['quantity'],
                        'total' => $row['total'],
                    ]
                );
        });

        return redirect()->route('receipt.index')->banner('Receipt Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Receipt $receipt
     * @return RedirectResponse
     */
    public function destroy(Receipt $receipt): RedirectResponse
    {
        $receipt->receipt_details()->delete();
        $receipt->delete();

        return redirect()->route('receipt.index')->banner('Receipt Deleted');
    }

    // removing a description field (fieldset) from the db
    public function deleteInfo($desc): RedirectResponse
    {
        $receipt_details = ReceiptDetails::query()->where('description', $desc)->first();
        $receipt_details?->delete();

        return redirect()->back()->banner('Description Removed');
    }

    public function sendMail($id): RedirectResponse
    {
        $receipt = Receipt::query()->with('user', 'customer')->findOrFail($id);
        $user = $receipt->customer->email;

        SendInvoiceMailJob::dispatch($user, $receipt);

//        return new InvoiceCreatedMail($receipt);
        return back()->banner("Receipt Sent to Customer's Mail");
    }
}
