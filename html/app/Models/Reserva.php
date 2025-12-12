<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'transfer_reservas';

    protected $primaryKey = 'id_reserva';
    
    public $timestamps = false; 

    // Campos que se pueden asignar masivamente (todos los campos que se llenarán)
    protected $fillable = [
    'localizador',
    'id_tipo_reserva',
    'email_cliente',

    // OWNER
    'id_owner',
    'tipo_owner',

    // CREADOR REAL
    'created_by_type',
    'created_by_id',

    // FECHAS
    'fecha_reserva',
    'fecha_modificacion',

    // HOTEL / DESTINO
    'id_hotel',
    'id_destino',

    // VIAJE
    'fecha_entrada',
    'hora_entrada',
    'numero_vuelo_entrada',
    'origen_vuelo_entrada',

    'fecha_vuelo_salida',
    'hora_vuelo_salida',
    'numero_vuelo_salida',
    'origen_vuelo_salida',
    'hora_recogida_hotel',

    // VEHÍCULO / PRECIO
    'num_viajeros',
    'id_vehiculo',
    'precio_total',
    'comision_ganada',
    'comision_liquidada',

    // ESTADO
    'estado',
];

    

     /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function hotel()
    {
        return $this->belongsTo(\App\Models\Hotel::class, 'id_hotel', 'id_hotel');
    }

    public function zona()
    {
        return $this->belongsTo(\App\Models\Zona::class, 'id_destino', 'id_zona');
    }

    public function owner()
    {
        return $this->belongsTo(\App\Models\Viajero::class, 'id_owner', 'id_viajero');
    }

    public function vehiculo()
    {
        return $this->belongsTo(\App\Models\Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

public function fechaLimite()
{
    if ($this->id_tipo_reserva == 1) {
        return \Carbon\Carbon::parse($this->fecha_entrada);
    }

    if ($this->id_tipo_reserva == 2) {
        return \Carbon\Carbon::parse($this->fecha_vuelo_salida);
    }

    if ($this->id_tipo_reserva == 3) {
        return \Carbon\Carbon::parse($this->fecha_entrada);
    }

    return null;
}

public function getEstadoFinalAttribute()
{
    if ($this->estado === 'anulada') {
        return 'Anulada';
    }

    $fechaTraslado = $this->fechaLimite();

    if ($fechaTraslado && $fechaTraslado->isPast()) {
        return 'Finalizada';
    }

    return 'Confirmada';
}


//Descriptores para mostrar tipo de traslado en lugar de ID's
public function getTipoTrasladoNombreAttribute()
{
    return match($this->id_tipo_reserva) {
        1 => 'Aeropuerto → Hotel',
        2 => 'Hotel → Aeropuerto',
        3 => 'Ida y Vuelta',
        default => 'Desconocido'
    };
}

public function puedeSerModificadaPor(string $rol): bool
{
    // Si está anulada → nadie puede
    if ($this->estado === 'anulada') {
        return false;
    }

    $fechaTraslado = $this->fechaLimite();

    // Si no hay fecha → por seguridad no permitir
    if (!$fechaTraslado) {
        return false;
    }

    // Si ya pasó → finalizada → nadie puede
    if ($fechaTraslado->isPast()) {
        return false;
    }

    // Admin siempre puede mientras no esté finalizada
    if ($rol === 'admin') {
        return true;
    }

    // Hotel y viajero → mínimo 48h antes
    return now()->diffInHours($fechaTraslado, false) > 48;
}

}