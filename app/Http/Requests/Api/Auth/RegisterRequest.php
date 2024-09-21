<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'bail|required',
            'email' => 'bail|required|email|max:254|unique:users,email',
            'password' => 'bail|required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.max' => 'Email is too long',
            'password.required' => 'Password is required',
            'email.unique' => 'The email has already been taken.'
        ];
    }
}
