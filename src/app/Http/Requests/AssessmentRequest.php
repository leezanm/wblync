<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'placement_id' => [
                'required',
                'exists:placements,id',
            ],

            'assessment_date' => [
                'required',
                'date',
            ],

            'score' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'grade' => [
                'nullable',
                'string',
                'max:10',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Draft',
                    'Submitted',
                    'Completed',
                ]),
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ];
    }
}
