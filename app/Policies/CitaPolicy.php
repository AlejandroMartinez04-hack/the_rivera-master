<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Empleado;

class CitaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // Determinar si el cliente o empleado puede actualizar la receta
    public function update(Cliente $user, Cita $cita)
     {
        return $cliente->id === $cita->cliente_id;
     }
    //Cliente o empleado puede actualizar la cita si es el dueño de la misma
    //     if ($user instanceof Cliente) {
    //         return $user->id === $cita->cliente_id;
    //     } 
    //     elseif ($user instanceof Empleado) {
    //         return $user->id === $cita->empleado_id;
    //     }
    //     return false;
    // }

    // Determinar si el cliente o empleado puede eliminar la cita
    public function delete(Cliente $user, Cita $cita)
    {
         return $cliente->id === $cita->cliente_id;
    //     if ($user instanceof Cliente) {
    //         return $user->id === $cita->cliente_id;
    //     } 
    //     if ($user instanceof Empleado) {
    //         return $user->id === $cita->empleado_id;    
    // }
    // return false;
    }

    // // Determinar si el empleado puede actualizar la cita
    // public function updateempleado(Empleado $empleado, Cita $cita)
    // {
    //     return $empleado->id === $cita->empleado_id;
    // }

    // // Determinar si el empleado puede eliminar la cita
    // public function deleteempleado(Empleado $empleado, Cita $cita)
    // {
    //     return $empleado->id === $cita->emplleado_id;
    // }
}
