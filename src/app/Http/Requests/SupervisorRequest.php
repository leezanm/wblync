<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supervisor = $this->route('supervisor');

        return [
            'lecturer_id' => [
                'required',
                'exists:lecturers,id',
                Rule::unique('supervisors')
                    ->where(fn ($query) => $query
                        ->where('lecturer_id', $this->input('lecturer_id'))
                        ->where('academic_session_id', $this->input('academic_session_id'))
                        ->where('semester_id', $this->input('semester_id')))
                    ->ignore($supervisor?->id),
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'semester_id' => [
                'required',
                'exists:semesters,id',
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
