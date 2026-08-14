<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndustrySupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => [
                'nullable',
                Rule::exists('companies', 'id')->where(function ($query) {
                    $query->where('status', true);
                }),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Active',
                    'Inactive',
                ]),
            ],
        ];
    }

}
