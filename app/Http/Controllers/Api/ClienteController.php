<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ClienteResource; // Importar el recurso ClienteResource 
use App\Http\Resources\ClienteCollection; // Importar la colección ClienteCollection
use App\Http\Requests\StoreClientesRequest; // Importar la request StoreClientesRequest
use App\Http\Requests\UpdateClientesRequest; // Importar la request UpdateClientesRequest
use Symfony\Component\HttpFoundation\Response; // Importar la clase Response para los códigos de estado HTTPz
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Importar el trait AuthorizesRequests para la autorización de politicas
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cliente; // Importar el modelo Cliente


class ClienteController extends Controller
{
    use AuthorizesRequests;
    // Muestra todos los clientes
    public function index(){
        $this->authorize('ver clientes');
        // return Categoria::all(); // Devuelve todos los clientes
        return new ClienteCollection(Cliente::all());  // Devuelve todos los clientes como recurso API
    }

    // Muestra un cliente a partir de su id
    public function show(Cliente $cliente){
        $this->authorize('ver clientes');
        // return $categoria; // Devuelve la categoria
        $cliente = $cliente->load('citas');  // Carga las citas relacionadas con el cliente
        return new ClienteResource($cliente);  // Devuelve el cliente como recurso API
        
    }

     // Almacena un nuevo cliente 
    public function store(StoreClientesRequest $request){  // Usar la request StoreClientesRequest para validar los datos
        $this->authorize('crear clientes');
        $cliente = $request->user()->clientes()->create($request->all());//Crear un nuevo cliente asociado al usuario autenticado
        //$cliente = Cliente::create($request->all());  // Crear un nuevo cliente con los datos validados    
       
        // Devolver el cliente creado como recurso API con código de estado 201 (creado) 
        return response()->json(new ClienteResource($cliente), Response::HTTP_CREATED); 
    }

     // Actualiza un cliente existente
    public function update(UpdateClientesRequest $request, Cliente $cliente){  // Usar la request UpdateClientesRequest para validar los datos
        $this->authorize('editar clientes');
        //$this->authorize('update', $cliente);  // Autorizar la acción usando la política ClientePolicy
        $cliente->update($request->all());  // Actualizar el cliente con los datos validados

        // Devolver el cliente actualizado como recurso API con código de estado 200 (OK)
        return response()->json(new ClienteResource($cliente), Response::HTTP_ACCEPTED);
    }

     // Elimina un cliente existente
    public function destroy(Cliente $cliente){  // Inyectar el cliente a eliminar   
        $this->authorize('eliminar clientes');
        //$this->authorize('delete', $cliente);  // Autorizar la acción usando la política ClientePolicy
        $cliente->delete();  // Eliminar el empleado

        // Devolver una respuesta vacía con código de estado 204 (No Content)
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
    
}
