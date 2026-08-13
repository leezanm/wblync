<?php

namespace App\Http\Requests;

use App\Models\AcademicSession;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AcademicSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $academicSession = $this->route('academic_session') ?? $this->route('academicSession');
        $academicSessionId = is_object($academicSession) ? $academicSession->getKey() : $academicSession;

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('academic_sessions', 'name')->ignore($academicSessionId),
            ],
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
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

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->hasAny(['start_date', 'end_date'])) {
                return;
            }

            $startDate = $this->input('start_date');
            $endDate = $this->input('end_date');

            if (! $startDate || ! $endDate) {
                return;
            }

            $academicSession = $this->route('academic_session') ?? $this->route('academicSession');
            $academicSessionId = is_object($academicSession) ? $academicSession->getKey() : $academicSession;

            $hasOverlap = AcademicSession::query()
                ->when($academicSessionId, fn ($query) => $query->whereKeyNot($academicSessionId))
                ->whereDate('start_date', '<=', $endDate)
                ->whereDate('end_date', '>=', $startDate)
                ->exists();

            if ($hasOverlap) {
                $validator->errors()->add('start_date', 'The academic session date range overlaps with an existing session.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Academic session name is required.',
            'name.unique' => 'The Academic Session Name already exists.',
            'name.max' => 'Academic session name may not exceed 100 characters.',
            'start_date.required' => 'Start date is required.',
            'start_date.date' => 'Please enter a valid start date.',
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'Please enter a valid end date.',
            'end_date.after' => 'End date must be after the start date.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be Draft, Active, or Closed.',
            'start_date.overlap' => 'The academic session date range overlaps with an existing session.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Academic Session Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->name ? trim((string) $this->name) : null,
        ]);
    }
}
