<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SemesterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'status' => [
                'required',
                Rule::in(['Draft', 'Active', 'Closed']),
            ],
            'current' => [
                'nullable',
                'boolean',
            ],
            'description' => [
                'nullable',
                'string',
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'academic_session_id.required' => 'Academic Session is required.',
            'academic_session_id.exists' => 'Selected Academic Session does not exist.',
            'name.required' => 'Semester name is required.',
            'start_date.required' => 'Start date is required.',
            'end_date.required' => 'End date is required.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            'status.required' => 'Status is required.',
        ];
    }

    public function attributes(): array
    {
        return [
            'academic_session_id' => 'Academic Session',
            'name' => 'Semester Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name
                ? trim($this->name)
                : null,
        ]);
    }
}
