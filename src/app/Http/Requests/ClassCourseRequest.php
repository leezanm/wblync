<?php

namespace App\Http\Requests;

use App\Models\ClassRoom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $classCourseId = $this->route('class_course')?->id;

        return [
            'class_room_id' => [
                'required',
                'exists:class_rooms,id',
            ],

            'course_id' => [
                'required',

                Rule::exists('courses', 'id')
                    ->where(function ($query) {
                        $classRoom = ClassRoom::find(
                            $this->class_room_id
                        );

                        if ($classRoom) {
                            $query->where(
                                'programme_id',
                                $classRoom->programme_id
                            );
                        }
                    }),

                Rule::unique('class_courses', 'course_id')
                    ->where(function ($query) {
                        return $query->where(
                            'class_room_id',
                            $this->class_room_id
                        );
                    })
                    ->ignore($classCourseId),
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

            'course_id.required' => 'Course is required.',

            'course_id.exists' => 'Selected course does not belong to the programme of the selected class.',

            'course_id.unique' => 'This course has already been assigned to the selected class.',

            'status.required' => 'Status is required.',
        ];
    }
}
