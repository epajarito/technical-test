<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class SavingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'description' => 'nullable|string|max:16000',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|decimal:0,2|min:1',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function messages(): array
    {

        return [
            'user_id.exists' => 'El usuario no existe',
            'user_id.required' => 'El usuario es obligatorio',
            'price.required' => 'El precio es obligatorio',
            'price.min' => 'El precio debe ser mayor a 0',
            'quantity.required' => 'La cantidad es obligatoria',
            'quantity.min' => 'La cantidad debe ser mayor a 0',
            'description.max' => 'La descripción no puede ser mayor a 16000 caracteres',
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre no puede ser mayor a 150 caracteres',
            'price.decimal' => 'El precio debe ser un número decimal con 2 decimales',
        ];
    }
}
