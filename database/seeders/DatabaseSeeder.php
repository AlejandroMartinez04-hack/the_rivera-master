<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory; // importar la clase Factory
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas
use Illuminate\Support\Str; // Para generar cadenas aleatorias

use App\Models\Empleado; // importar el modelo Empleado
use App\Models\Cliente; // importar el modelo Cliente
use App\Models\Servicio; // importar el modelo Servicio
use App\Models\Cita; // importar el modelo Cita
//use App\Models\Login; // importar el modelo Login
use Illuminate\Support\Facades\DB;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Cliente::factory()->create([
            'name' => 'Alejandro Martinez',
            'email' => 'alxmartinez456@laravel.com',
        ]);

        Cliente::factory(29)->create();
        Empleado::factory(3)->create();
        Servicio::factory(10)->create();
        Cita::factory(40)->create();
        //Login::factory(20)->create();

    // Relación muchos a muchos
        //CITAS - SERVICIOS
        $citas = Cita::all();
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $servicios = Servicio::all();

        // Asignar entre 2 y 4 servicios aleatorias a cada cita
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
        foreach ($citas as $cita) {
            $cita->servicios()->attach($servicios->random(rand(2, 4)));
        }

        //CLIENTE - SERVICIOS
        // Asignar entre 2 y 4 servicios aleatorias a cada cliente
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
        foreach ($clientes as $cliente) {
            $cliente->servicios()->attach($servicios->random(rand(2, 4)));
        }

        //EMPLEADO - SERVICIOS
        // Asignar entre 2 y 4 servicios aleatorias a cada cita
        // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
        foreach ($empleados as $empleado) {
            $empleado->servicios()->attach($servicios->random(rand(2, 4)));
        }
        

        // // Logins relacionados
        // Login::factory(20)->create()->each(function ($login) {
        //     $login->cliente_id = Cliente::all()->random()->id;
        //     $login->empleado_id = Empleado::all()->random()->id;
        //     $login->save();
        // });

    }
}
