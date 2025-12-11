@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Mis Reservas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Localizador</th>
                <th>Hotel</th>
                <th>Email Cliente</th>
                <th>Fecha Traslado</th>
                <th>Origen</th>
<th>Destino</th>
<th>Zona</th>
<th>Vehículo</th>
                <th>Num Viajeros</th>
                <th>Precio Total</th>
                <th>Comisión</th>
                <th>Acciones</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
            @php
    // Fecha usada para las restricciones
    $reserva_fecha   = \Carbon\Carbon::parse($reserva->fecha_reserva);
    $puede_modificar = $reserva_fecha->diffInHours($now, false) > 48 || $rol == 'admin';

    // ORIGEN / DESTINO según el tipo de reserva
    $origen  = '';
    $destino = '';

    $hotelNombre = $reserva->hotel->nombre ?? 'Sin hotel';

    switch ($reserva->id_tipo_reserva) {
        case 1: // Aeropuerto → Hotel (IDA)
            // Origen = aeropuerto de llegada / operación
            $origen  = $reserva->origen_vuelo_entrada ?: 'Aeropuerto';
            // Destino = hotel
            $destino = $hotelNombre;
            break;

        case 2: // Hotel → Aeropuerto (VUELTA)
            // Origen = hotel
            $origen  = $hotelNombre;
            // Destino = aeropuerto de salida
            $destino = $reserva->origen_vuelo_salida ?: 'Aeropuerto';
            break;

        case 3: // Ida y Vuelta
            // Puedes mostrar ambos tramos
            $origen  = ($reserva->origen_vuelo_entrada ?: 'Aeropuerto') . ' / ' . $hotelNombre;
            $destino = $hotelNombre . ' / ' . ($reserva->origen_vuelo_salida ?: 'Aeropuerto');
            break;

        default:
            $origen  = 'Desconocido';
            $destino = 'Desconocido';
            break;
    }
@endphp

            <tr>
                <td>{{ $reserva->id_reserva }}</td>
                <td>{{ $reserva->localizador }}</td>
                <td>{{ $reserva->hotel->nombre ?? 'Sin hotel' }}</td>
                <td>{{ $reserva->email_cliente }}</td>
                <td>
    @if($reserva->id_tipo_reserva == 1)
        {{ $reserva->fecha_entrada }}
    @elseif($reserva->id_tipo_reserva == 2)
        {{ $reserva->fecha_vuelo_salida }}
    @elseif($reserva->id_tipo_reserva == 3)
        {{ $reserva->fecha_entrada }} / {{ $reserva->fecha_vuelo_salida }}
    @endif
</td>

<td>{{ $origen }}</td>
<td>{{ $destino }}</td>
<td>{{ $reserva->zona->descripcion ?? 'Sin zona' }}</td>
<td>{{ $reserva->vehiculo->descripcion ?? 'Sin vehículo' }}</td>
<td>{{ $reserva->num_viajeros }}</td>
                <td>{{ $reserva->precio_total }} €</td>
                <td>{{ $reserva->comision_ganada }} €</td>
                <td>
                    @if($puede_modificar && $reserva->estado !== 'anulada')
                        <a href="{{ route('reserva.edit', $reserva->id_reserva) }}" class="btn btn-sm btn-primary">Modificar</a>
                        <form action="{{ route('reserva.destroy', $reserva->id_reserva) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    @else
                        <span class="text-muted">No disponible</span>
                    @endif
                </td>
                <td>
    <span class="badge 
        @if($reserva->estado_final == 'Anulada') bg-danger
        @elseif($reserva->estado_final == 'Finalizada') bg-secondary
        @else bg-success
        @endif">
        {{ $reserva->estado_final }}
    </span>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
