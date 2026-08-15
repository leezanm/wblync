<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProgrammeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $programmeId = $this->route('programme')?->id;

        return [
            'code' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('programmes', 'code')
                    ->ignore($programmeId),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'duration' => [
                'nullable',
                'numeric',
                'min:1',
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
            'code.required' => 'Programme code is required.',
            'code.unique' => 'This programme code already exists.',
            'code.alpha_dash' => 'Programme code may only contain letters, numbers, dashes and underscores.',

            'name.required' => 'Programme name is required.',

            'description.max' => 'Description may not exceed 1000 characters.',

            'duration.numeric' => 'Duration must be a valid number.',

            'duration.min' => 'Duration must be at least 1 year.',

            'duration.max' => 'Duration may not exceed 10 years.',

            'status.required' => 'Programme status is required.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => $this->code
                ? strtoupper(trim($this->code))
                : null,

            'name' => $this->name
                ? trim($this->name)
                : null,
        ]);
    }
}
