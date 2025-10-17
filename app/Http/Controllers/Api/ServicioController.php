<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServicioResource; // Importar el recurso ServicioResource 
use App\Http\Resources\ServicioCollection; // Importar la colección ServicioCollection
use App\Http\Requests\StoreServiciosRequest; // Importar la request StoreServiciosRequest
use App\Http\Requests\UpdateServiciosRequest; // Importar la request UpdateServiciosRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTP


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Servicio; // Importar el modelo Servicio

class ServicioController extends Controller
{
    // Muestra todos los servicios
    public function index(){
        // return Categoria::all(); // Devuelve todos los clientes
        return new ServicioCollection(Servicio::all());  // Devuelve todos los servicios como recurso API
    }

    // Muestra un servicio a partir de su id
    public function show(Servicio $servicio){
        // return $categoria; // Devuelve la categoria
        $servicio = $servicio->load('citas');  // Carga las citas relacionadas con el servicio
        return new ServicioResource($servicio);  // Devuelve el servicio como recurso API     
    }

     // Almacena un nuevo servicio 
    public function store(StoreServiciosRequest $request){  // Usar la request StoreServiciosRequest para validar los datos
        $servicio = Servicio::create($request->all());  // Crear un nuevo servicio con los datos validados    
       
        // Devolver el servicio creado como recurso API con código de estado 201 (creado) 
        return response()->json(new ServicioResource($servicio), Response::HTTP_CREATED); 
    }

     // Actualiza un servicio existente
    public function update(UpdateServiciosRequest $request, Servicio $servicio){  // Usar la request UpdateServiciosRequest para validar los datos
        $servicio->update($request->all());  // Actualizar el servicio con los datos validados

        // Devolver el servicio actualizado como recurso API con código de estado 200 (OK)
        return response()->json(new ServicioResource($servicio), Response::HTTP_OK);
    }

     // Elimina un servicio existente
    public function destroy(Servicio $servicio){  // Inyectar el servicio a eliminar
        $servicio->delete();  // Eliminar el servicio

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
    
}
