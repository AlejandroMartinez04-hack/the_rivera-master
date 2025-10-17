<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'empleado_id' => \App\Models\Empleado::all()->random()->id, // Asignar un Empleado aleatorio existente a la cita
            'cliente_id' => \App\Models\Cliente::all()->random()->id, // Asignar un Cliente aleatorio existente a la cita
            //'servicio_id' => \App\Models\Servicio::all()->random()->id, // Asignar un Servicio aleatorio existente a la cita
            'fecha_hora' => fake()->dateTimeBetween('+1 days', '+1 month'), // Fecha y hora aleatoria en el futuro
        ];
    }
}
