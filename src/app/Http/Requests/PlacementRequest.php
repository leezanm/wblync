<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlacementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $placementId = $this->route('placement')?->id;

        return [
            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'company_id' => [
                'required',
                'exists:companies,id',
            ],

            'company_contact_id' => [
                'nullable',
                Rule::exists('company_contacts', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'company_id',
                            $this->input('company_id')
                        )->where(
                            'status',
                            'Active'
                        );
                    }),
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
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

            'remarks' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student is required.',

            'student_id.exists' => 'Selected student does not exist.',

            'company_id.required' => 'Company is required.',

            'company_id.exists' => 'Selected company does not exist.',

            'academic_session_id.required' => 'Academic session is required.',

            'academic_session_id.exists' => 'Selected academic session does not exist.',

            'start_date.required' => 'Start date is required.',

            'end_date.required' => 'End date is required.',

            'end_date.after_or_equal' => 'End date must be on or after the start date.',

        ];
    }
}
