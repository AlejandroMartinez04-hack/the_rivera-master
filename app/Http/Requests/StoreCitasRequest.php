<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permitir que cualquier usuario pueda hacer esta request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'empleado_id' => 'required|exists:empleados,id', // El empleado_id es obligatorio y debe existir en la tabla empleados
            //'cliente_id' => 'required|exists:clientes,id', // El cliente_id es obligatorio y debe exsistir en la tabla clientes
            'fecha_hora' => 'required|date', // La fecha_hora es obligatoria y debe ser una fecha valida
            'servicios' => 'required', // Los servicios son opcionales y deben ser un array
        ];
    }
}
