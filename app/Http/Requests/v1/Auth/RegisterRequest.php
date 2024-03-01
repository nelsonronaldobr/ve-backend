<?php

namespace App\Http\Requests\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'unique:emails,email'],
            'sex' => ['required', 'string', 'in:male,female,other'],
            'birth_date' => [
                'required',
                'date',
                'before_or_equal:today',
                'date_format:Y-m-d',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],
            'password' => [
                'required',
                Password::min(6)->letters()->symbols()->numbers()
            ]
        ];
    }
}
