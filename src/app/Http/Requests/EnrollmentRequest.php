<?php

namespace App\Http\Requests;

use App\Models\ClassCourse;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $enrollmentId = $this->route('enrollment')?->id;

        return [
            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'class_course_id' => [
                'required',
                'exists:class_courses,id',

                Rule::unique('enrollments', 'class_course_id')
                    ->where(function ($query) {
                        return $query->where(
                            'student_id',
                            $this->student_id
                        );
                    })
                    ->ignore($enrollmentId),
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            $student = Student::find(
                $this->student_id
            );

            $classCourse = ClassCourse::find(
                $this->class_course_id
            );

            if (! $student || ! $classCourse) {
                return;
            }

            if (
                $student->class_room_id !==
                $classCourse->class_room_id
            ) {
                $validator->errors()->add(
                    'class_course_id',
                    'The selected course is not offered to the student\'s class.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'student_id.required' => 'Student is required.',

            'student_id.exists' => 'Selected student is invalid.',

            'class_course_id.required' => 'Class course is required.',

            'class_course_id.exists' => 'Selected class course is invalid.',

            'class_course_id.unique' => 'This student is already enrolled in the selected course.',

            'status.required' => 'Status is required.',
        ];
    }
}
