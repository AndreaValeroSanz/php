<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'transfer_vehiculos';
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = false; 

    protected $fillable = [
        'descripcion',
        'email_conductor',
        'password',
    ];

    public function getDescripcionAttribute() //Función para acceder al atributo descripción sin tilde
    {
        return $this->attributes['descripcion'] ?? null;
    }

    public function reservas()
{
    return $this->hasMany(\App\Models\Reserva::class, 'id_vehiculo', 'id_vehiculo');
}

}