<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory; // importar la clase Factory
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas
use Illuminate\Support\Str; // Para generar cadenas aleatorias

use App\Models\Empleado; // importar el modelo Empleado
use App\Models\Cliente; // importar el modelo Cliente
use App\Models\Servicio; // importar el modelo Servicio
use App\Models\Cita; // importar el modelo Cita
use App\Models\Login; // importar el modelo Login
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
        Login::factory(20)->create();

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
        // // Citas relacionadas
        // Cita::factory(40)->create()->each(function ($cita) {
        //     $cita->cliente_id = Cliente::all()->random()->id;
        //     $cita->empleado_id = Empleado::all()->random()->id;
        //     $cita->servicio_id = Servicio::all()->random()->id;
        //     $cita->save();
        // });
        // Crear citas (sin servicio_id)
        // Cita::factory(40)->create()->each(function ($cita) {
        //     // Asignar cliente y empleado aleatorios
        //     $cita->cliente_id = Cliente::inRandomOrder()->first()->id;
        //     $cita->empleado_id = Empleado::inRandomOrder()->first()->id;
        //     $cita->save();

        //     // Asignar entre 1 y 3 servicios aleatorios a la cita (tabla pivote cita_servicio)
        //     $servicios = Servicio::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $cita->servicios()->attach($servicios);
        // });

        // Logins relacionados
        Login::factory(20)->create()->each(function ($login) {
            $login->cliente_id = Cliente::all()->random()->id;
            $login->empleado_id = Empleado::all()->random()->id;
            $login->save();
        });








        // Cita::all()->each(function ($cita) {
        //     DB::table('cita_empleado_cliente_servicio')->insert([
        //     'cita_id' => $cita->id,
        //     'cliente_id' => Cliente::all()->random()->id,
        //     'empleado_id' => Empleado::all()->random()->id,
        //     'servicio_id' => Servicio::all()->random()->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ]);
        // });
    //     Cita::all()->each(function ($cita) {
    //         DB::table('cita_empleado_cliente_servicio')->insert([
    //             'cita_id' => $cita->id,
    //             'cliente_id' => $cita->cliente_id, // usa el cliente real de la cita
    //             'empleado_id' => $cita->empleado_id, // usa el empleado real
    //             'servicio_id' => Servicio::all()->random()->id,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    // });


        // Login::all()->each(function ($login) {
        //     DB::table('login_empleado_cliente')->insert([
        //     'cliente_id' => Cliente::all()->random()->id,
        //     'empleado_id' => Empleado::all()->random()->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     ]);
        // });

        // Relación muchos a muchos
        // $citas = Cita::all();
        // $servicios = Servicio::all();

        // // Asignar entre 2 y 4 etiquetas aleatorias a cada receta
        // // attach() agrega registros a la tabla intermedia sin eliminar los existentes 
        // foreach ($citas as $cita) {
        //     $cita->servicios()->attach($servicios->random(rand(2, 4)));
        // }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
