<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; //Importar el trait HasRoles para manejar roles y permisos

class Empleado extends Authenticatable
{
    protected $guard_name = 'web';// Definir el guard para Spatie Roles y Permisos
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
     use HasApiTokens, HasFactory, Notifiable, HasRoles;// Usar el trait HasRoles para manejar roles y permisos

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
        //'es_admin',
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
            //'es_admin' => 'boolean', // ← Cast para el campo admin
        ];
    }

   // Relación 1:N (Un empleado tiene muchas citas)
     public function citas(){
          return $this->hasMany(Cita::class);
      }

      // Relación N:N (Un empleado puede tener muchos servicios)
      public function servicios(){
         //return $this->belongsToMany(Servicio::class, 'empleado_servicio', 'empleado_id', 'servicio_id');
         return $this->belongsToMany(Servicio::class);
     }

        // Relación 1:N (Un empleado tiene muchos clientes)
        public function clientes(){
            return $this->hasMany(Cliente::class);
        }
}