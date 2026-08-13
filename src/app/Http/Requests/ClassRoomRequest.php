<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $classRoomId = $this->route('class')?->id;

        return [
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'semester_id' => [
                'required',

                Rule::exists('semesters', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'academic_session_id',
                            $this->academic_session_id
                        );
                    }),
            ],

            'programme_id' => [
                'required',

                Rule::exists('programmes', 'id')
                    ->where(function ($query) {
                        $query->where('status', true);
                    }),
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',

                Rule::unique('class_rooms', 'code')
                    ->where(function ($query) {
                        return $query
                            ->where(
                                'academic_session_id',
                                $this->academic_session_id
                            )
                            ->where(
                                'semester_id',
                                $this->semester_id
                            )
                            ->where(
                                'programme_id',
                                $this->programme_id
                            );
                    })
                    ->ignore($classRoomId),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
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
            'academic_session_id.required' => 'Academic session is required.',

            'academic_session_id.exists' => 'Selected academic session is invalid.',

            'semester_id.required' => 'Semester is required.',

            // 'semester_id.exists' =>
            //     'Selected semester is invalid.',

            'semester_id.exists' => 'Selected semester does not belong to the selected academic session.',
            'programme_id.required' => 'Programme is required.',

            'programme_id.exists' => 'Selected programme is invalid.',

            'code.required' => 'Class code is required.',

            'code.unique' => 'This class code already exists for the selected academic session, semester and programme.',

            'name.required' => 'Class name is required.',
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
