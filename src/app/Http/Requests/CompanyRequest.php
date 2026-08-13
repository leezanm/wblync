<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $companyId = $this->route('company')?->id;

        return [
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies', 'code')
                    ->ignore($companyId),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'registration_no' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('companies', 'registration_no')
                    ->ignore($companyId),
            ],

            'industry' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'nullable',
                'string',
                'max:100',
            ],

            'postcode' => [
                'nullable',
                'string',
                'max:10',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Company code is required.',

            'code.unique' => 'This company code is already in use.',

            'name.required' => 'Company name is required.',

            'registration_no.unique' => 'This registration number is already registered.',

            'email.email' => 'Please enter a valid email address.',

            'website.url' => 'Please enter a valid website URL.',

            'status.required' => 'Status is required.',
        ];
    }
}
