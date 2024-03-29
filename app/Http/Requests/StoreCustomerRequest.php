<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'email' => ['nullable', 'email', 'unique:customers,email', 'max:255'],
            'address_1' => ['string', 'sometimes', 'nullable', 'max:255'],
            'address_2' => ['string', 'sometimes', 'nullable', 'max:255'],
        ];
    }
}
