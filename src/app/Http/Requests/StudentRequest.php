<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student')?->id;

        return [
            'class_room_id' => [
                'required',
                'exists:class_rooms,id',
            ],

            'student_no' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_no')
                    ->ignore($studentId),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'ic_no' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('students', 'ic_no')
                    ->ignore($studentId),
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
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
            'class_room_id.required' => 'Class is required.',

            'class_room_id.exists' => 'Selected class is invalid.',

            'student_no.required' => 'Student number is required.',

            'student_no.unique' => 'This student number already exists.',

            'name.required' => 'Student name is required.',

            'ic_no.unique' => 'This IC number is already registered.',

            'email.email' => 'Please enter a valid email address.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'student_no' => $this->student_no
                ? strtoupper(trim($this->student_no))
                : null,

            'name' => $this->name
                ? trim($this->name)
                : null,

            'ic_no' => $this->ic_no
                ? trim($this->ic_no)
                : null,

            'email' => $this->email
                ? strtolower(trim($this->email))
                : null,

            'phone' => $this->phone
                ? trim($this->phone)
                : null,
        ]);
    }
}
