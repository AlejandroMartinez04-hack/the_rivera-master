<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
     use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ //campos que se pueden asignar masivamente
        'name',
        'email',
        'telefono',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación 1:N (Un cliente tiene muchas citas)
     public function citas(){
         return $this->hasMany(Cita::class);
     }

     // Relación N:N (Un cliente puede tener muchos servicios)
     public function servicios(){
        //return $this->belongsToMany(Servicio::class, 'cliente_servicio', 'cliente_id', 'servicio_id');
        return $this->belongsToMany(Servicio::class);

    }
}

// class Cliente extends Model
// {
//     /** @use HasFactory<\Database\Factories\ClienteFactory> */
//     use HasFactory;

//     protected $fillable = [ //campos que se pueden asignar masivamente
//         'name',
//         'email',
//         'telefono',
//         'password',
//     ];

//     // Relación 1:N (Un cliente tiene muchas citas)
//      public function citas(){
//          return $this->hasMany(Cita::class);
//      }

//      // Relación N:N (Un cliente puede tener muchos servicios)
//      public function servicios(){
//         //return $this->belongsToMany(Servicio::class, 'cliente_servicio', 'cliente_id', 'servicio_id');
//         return $this->belongsToMany(Servicio::class);

//     }
//     // Relación con la tabla pivote (un cliente puede tener muchos registros en la tabla pivote)
//     //public function detallesCita()
//     //{
//     //return $this->hasMany(CitaEmpleadoClienteServicio::class);
//     //}

    
// }