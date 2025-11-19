<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadosRequest extends FormRequest
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
            'name' => 'required|string|max:255', // El nombre es opcional, debe ser una cadena y no exceder 255 caracteres
            'email' => 'sometimes|email|unique:empleados,email,' . $this->route('empleado')->id, // El email es opcional, debe ser un email valido y unico en la tabla empleados, ignorando el empleado actual
            'telefono' => 'sometimes|string|max:20', // El telefono es opcional, debe ser una cadena y no exceder 20 caracteres
            'password' => 'sometimes|string|max:500', // La direccion es opcional, debe ser una cadena y no exceder 500 caracteres
        ];
    }
}
