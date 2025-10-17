<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importar controladores
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ServicioController;

// Rutas de Citas
Route::apiResource('citas', CitaController::class);

// Rutas de Clientes
Route::apiResource('clientes', ClienteController::class);

// Rutas de Empleados
Route::apiResource('empleados', EmpleadoController::class);

// Rutas de Logins
Route::apiResource('logins', LoginController::class);

//Rutas de Servicios
Route::apiResource('servicios', ServicioController::class);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
