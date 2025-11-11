<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EmpleadoResource; // Importar el recurso EmpleadoResource 
use App\Http\Resources\EmpleadoCollection; // Importar la colección EmpleadoCollection
use App\Http\Requests\StoreEmpleadosRequest; // Importar la request StoreEmpleadosRequest
use App\Http\Requests\UpdateEmpleadosRequest; // Importar la request UpdateEmpleadosRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTP
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait AuthorizesRequests para la autorización de politicas



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empleado; // Importar el modelo Empleado

class EmpleadoController extends Controller
{
    use AuthorizesRequests;
     // Muestra todos los empleados
    public function index(){
        $this->authorize('ver empleados');
        // return Categoria::all(); // Devuelve todos los clientes
        return new EmpleadoCollection(Empleado::all());  // Devuelve todos los empleados como recurso API
    }

    // Muestra un empleado a partir de su id
    public function show(Empleado $empleado){
        $this->authorize('ver empleados');
        // return $categoria; // Devuelve la categoria
        $empleado = $empleado->load('citas');  // Carga las citas relacionadas con el empleado
        return new EmpleadoResource($empleado);  // Devuelve el empleado como recurso API        
    }

    // Almacena un nuevo empleado 
    public function store(StoreEmpleadosRequest $request){  // Usar la request StoreEmpeadosRequest para validar los datos
        $this->authorize('crear empleados');
        $empleado = Empleado::create($request->all());  // Crear un nuevo empleado con los datos validados    
        //$empleado = $request->user()->empleados()->create($request->all());  // Crear un nuevo empleado asociada al usuario autenticado
       
        // Devolver el empleado creado como recurso API con código de estado 201 (creado) 
        return response()->json(new EmpleadoResource($empleado), Response::HTTP_CREATED); 
    }

     // Actualiza un empleado existente
    public function update(UpdateEmpleadosRequest $request, Empleado $empleado){  // Usar la request UpdateEmpleadosRequest para validar los datos
        $this->authorize('editar empleados');
        //$this->authorize('update', $empleado);  // Autorizar la acción usando la política EmpleadoPolicy
        $empleado->update($request->all());  // Actualizar el empleado con los datos validados

        // Devolver el empleado actualizado como recurso API con código de estado 200 (OK)
        return response()->json(new EmpleadoResource($empleado), Response::HTTP_ACCEPTED);
    }

     // Elimina un empleado existente
    public function destroy(Empleado $empleado){  // Inyectar el empleado a eliminar
        $this->authorize('eliminar empleados');
        //$this->authorize('delete', $empleado);  // Autorizar la acción usando la política EmpleadoPolicy
        $empleado->delete();  // Eliminar el empleado

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
    
}
