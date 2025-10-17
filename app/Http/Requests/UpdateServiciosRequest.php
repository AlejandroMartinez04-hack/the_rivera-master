<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiciosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255', // El nombre es opcional, debe ser una cadena y no exceder 255 caracteres
            'precio' => 'sometimes|numeric|min:0', // El precio es opcional, debe ser numerico y mayor o igual a 0
            'duration' => 'sometimes|integer|min:1', // La duracion es opcional, debe ser un entero y mayor o igual a 1
        ];
    }
}
