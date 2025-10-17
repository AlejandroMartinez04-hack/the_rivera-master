<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    protected $fillable = [ //campos que se pueden asignar masivamente
        'name',
        'email',
        'telefono',
        'password',
    ];

    // Relación 1:N (Un cliente tiene muchas citas)
     public function citas(){
         return $this->hasMany(Cita::class);
     }

     // Relación N:N (Un cliente puede tener muchos servicios)
     public function servicios(){
        //return $this->belongsToMany(Servicio::class, 'cliente_servicio', 'cliente_id', 'servicio_id');
        return $this->belongsToMany(Servicio::class);

    }
    // Relación con la tabla pivote (un cliente puede tener muchos registros en la tabla pivote)
    //public function detallesCita()
    //{
    //return $this->hasMany(CitaEmpleadoClienteServicio::class);
    //}

    
}
