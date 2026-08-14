<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                Password::defaults(),
                'confirmed',
                'different:current_password',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.current_password' => 'Kata laluan semasa tidak tepat.',
            'password.confirmed' => 'Pengesahan kata laluan baharu tidak sepadan.',
            'password.different' => 'Kata laluan baharu mesti berbeza daripada kata laluan semasa.',
        ];
    }
}
