<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanySettingsRequest extends FormRequest
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
            'company_name' => ['required', 'string', 'max:255'],
            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['nullable', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'max:255'],
            'office_no' => ['nullable', 'string', 'max:255'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'min:10', 'max:255'],
            'logo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:4096'],
        ];
    }

    public function messages()
    {
        return [
            'address_1.required' => 'This address is required.',
            'address_1.max' => 'This address must not be more than 255 characters.',
        ];
    }
}
