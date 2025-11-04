<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Empleado;


class EmpleadoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
     // Determinar si el empleado puede actualizar algun empleado
    public function update(Empleado $user, Empleado $empleado)
     {
        return $user->id === $empleado->id;
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
    public function delete(Empleado $user, Empleado $empleado)
    {
         return $user->id === $empleado->id;
    //     if ($user instanceof Cliente) {
    //         return $user->id === $cita->cliente_id;
    //     } 
    //     if ($user instanceof Empleado) {
    //         return $user->id === $cita->empleado_id;    
    // }
    // return false;
    }
}
