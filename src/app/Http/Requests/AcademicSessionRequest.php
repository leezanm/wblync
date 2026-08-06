<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        $id = $this->route('academic_session');

        return [

            'code' => [
                'required',
                'max:20',
                'unique:academic_sessions,code,' . $id,
            ],

            'name' => [
                'required',
                'max:255',
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

            'status' => [
                'required',
                'in:Draft,Active,Closed',
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

    public function attributes(): array
    {
        return [

            'code' => 'Academic Session Code',

            'name' => 'Academic Session Name',

            'start_date' => 'Start Date',

            'end_date' => 'End Date',

        ];
    }
}
