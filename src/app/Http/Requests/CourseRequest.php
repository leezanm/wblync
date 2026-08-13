<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courseId = $this->route('course')?->id;

        return [
            'programme_id' => [
                'required',
                'exists:programmes,id',
            ],

            'code' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',

                Rule::unique('courses', 'code')
                    ->where(
                        fn ($query) => $query->where(
                            'programme_id',
                            $this->programme_id
                        )
                    )
                    ->ignore($courseId),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'credit_hours' => [
                'required',
                'integer',
                'min:1',
                'max:20',
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
            'programme_id.required' => 'Programme is required.',

            'programme_id.exists' => 'Selected programme is invalid.',

            'code.required' => 'Course code is required.',

            'code.unique' => 'This course code already exists for the selected programme.',

            'name.required' => 'Course name is required.',

            'credit_hours.required' => 'Credit hours is required.',

            'credit_hours.min' => 'Credit hours must be at least 1.',
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
