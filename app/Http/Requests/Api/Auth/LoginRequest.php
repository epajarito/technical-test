<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {

        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.exists' => 'Email does not exist',
            'password.required' => 'Password is required',
        ];
    }
}
