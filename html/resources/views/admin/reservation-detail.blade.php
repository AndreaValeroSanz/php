@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Detalle de la Reserva #{{ $reserva->id_reserva }}</h2>

    <a href="{{ route('admin.reservations.list') }}" class="btn btn-secondary mb-3">Volver al listado</a>

    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>ID Reserva</th>
                <td>{{ $reserva->id_reserva }}</td>
            </tr>
            <tr>
                <th>Localizador</th>
                <td>{{ $reserva->localizador }}</td>
            </tr>
            <tr>
                <th>Hotel</th>
                <td>{{ $reserva->hotel->nombre ?? 'Sin hotel' }}</td>
            </tr>
            <tr>
                <th>Tipo Reserva</th>
                <td>{{ $reserva->tipo_traslado_nombre }}</td>
            </tr>
            <tr>
                <th>Email Cliente</th>
                <td>{{ $reserva->email_cliente }}</td>
            </tr>
            <tr>
                <th>Fecha de Reserva</th>
                <td>{{ $reserva->fecha_reserva }}</td>
            </tr>
            <tr>
                <th>Fecha Modificación</th>
                <td>{{ $reserva->fecha_modificacion }}</td>
            </tr>
            <tr>
                <th>Zona / Destino</th>
                <td>{{ $reserva->zona->nombre ?? 'Sin destino' }}</td>
            </tr>
            <tr>
                <th>Fecha Entrada</th>
                <td>{{ $reserva->fecha_entrada }}</td>
            </tr>
            <tr>
                <th>Hora Entrada</th>
                <td>{{ $reserva->hora_entrada }}</td>
            </tr>
            <tr>
                <th>Nº Vuelo Entrada</th>
                <td>{{ $reserva->numero_vuelo_entrada }}</td>
            </tr>
            <tr>
                <th>Origen Vuelo Entrada</th>
                <td>{{ $reserva->origen_vuelo_entrada }}</td>
            </tr>
            <tr>
                <th>Hora Vuelo Salida</th>
                <td>{{ $reserva->hora_vuelo_salida }}</td>
            </tr>
            <tr>
                <th>Fecha Vuelo Salida</th>
                <td>{{ $reserva->fecha_vuelo_salida }}</td>
            </tr>
            <tr>
                <th>Nº Vuelo Salida</th>
                <td>{{ $reserva->numero_vuelo_salida }}</td>
            </tr>
            <tr>
                <th>Origen Vuelo Salida</th>
                <td>{{ $reserva->origen_vuelo_salida }}</td>
            </tr>
            <tr>
                <th>Hora Recogida en Hotel</th>
                <td>{{ $reserva->hora_recogida_hotel }}</td>
            </tr>
            <tr>
                <th>Número de Viajeros</th>
                <td>{{ $reserva->num_viajeros }}</td>
            </tr>
            <tr>
                <th>Owner</th>
                <td>({{ $reserva->tipo_owner }}) {{ $reserva->owner->nombre ?? 'No encontrado' }}</td>
            </tr>
            <tr>
                <th>Vehículo</th>
                <td>{{ $reserva->vehiculo->descripcion ?? 'Sin vehículo' }}</td>
            </tr>
            <tr>
                <th>Precio Total</th>
                <td>{{ number_format($reserva->precio_total, 2) }} €</td>
            </tr>
            <tr>
                <th>Comisión Ganada</th>
                <td>{{ number_format($reserva->comision_ganada, 2) }} €</td>
            </tr>
            <tr>
                <th>Comisión Liquidada</th>
                <td>{{ number_format($reserva->comision_liquidada, 2) }} €</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
