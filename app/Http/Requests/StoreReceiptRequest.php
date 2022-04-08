<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'number' => ['sometimes', 'nullable', 'min:11'],
            'email' => ['nullable', 'email', 'max:255'],
            'address_1' => ['string', 'sometimes', 'nullable', 'max:255'],
            'address_2' => ['string', 'sometimes', 'nullable', 'max:255'],
            'serial_no' => ['required', 'integer', 'digits_between:7,14'], //optional
            'issue_date' => ['required', 'date'],
            'payment_method' => ['required'],
            'info.*.description' => ['required', 'string', 'max:255', 'unique:invoice_details'],
            'info.*.unit_price' => ['required', 'numeric'],
            'info.*.quantity' => ['required', 'integer'],
            'info.*.total' => ['required', 'numeric'],
            'sum_total' => ['required', 'numeric'],
            'discount' => ['required', 'integer'],
            'sub_total' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'info.*.description.required' => 'The description is required',
            'info.*.unit_price.required' => 'The unit price is required',
            'info.*.quantity.required' => 'The quantity is required',
            'info.*.total.required' => 'The total is required',
            'info.*.description.unique' => 'This description has already been used',
        ];
    }
}
