<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DailyLogbookRequest extends FormRequest
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

            'log_date' => [
                'required',
                'date',
            ],

            'work_status' => [
                'required',
                Rule::in([
                    'Working',
                    'Off Day',
                    'Public Holiday',
                    'Leave',
                    'Medical Leave',
                ]),
            ],

            'activity' => [
                'required',
                'string',
            ],

            'learning_outcome' => [
                'nullable',
                'string',
            ],

            'working_hours' => [
                'nullable',
                'numeric',
                'min:0',
                'max:24',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Draft',
                    'Submitted',
                    'Approved',
                    'Rejected',
                ]),
            ],

            'remarks' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $workStatus = $this->input('work_status');

        if ($workStatus && $workStatus !== 'Working') {
            $this->merge([
                'activity' => $workStatus,
            ]);
        }
    }
}
