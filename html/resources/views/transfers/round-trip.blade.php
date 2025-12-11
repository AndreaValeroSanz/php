@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h4>Reservar Traslado: Ida y Vuelta</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('transfer.reserve.confirm') }}">
                    @csrf
                    <input type="hidden" name="reservation_type" value="round_trip">

                    @error('hotel')
                        <div class="alert alert-danger text-center">{{ $message }}</div>
                    @enderror

                    <div class="alert alert-warning small">
                        <i class="fas fa-clock"></i> **Nota:** La reserva debe realizarse con al menos **48 horas de antelación**.
                    </div>
                    
                    {{-- SECCIÓN IDA --}}
                    <h4 class="mb-4 text-success"><i class="fas fa-road"></i> IDA: Aeropuerto → Hotel</h4>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_llegada" class="form-label">Día de Llegada</label>
                            <input type="date" class="form-control" id="fecha_llegada" name="fecha_llegada" value="{{ old('fecha_llegada') }}" min="{{ Carbon\Carbon::parse($minDate)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="hora_llegada" class="form-label">Hora Llegada</label>
                            <input type="time" class="form-control" id="hora_llegada" name="hora_llegada" value="{{ old('hora_llegada') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="num_vuelo_ida" class="form-label">Nº Vuelo (Ida)</label>
                            <input type="text"
       class="form-control"
       id="num_vuelo_ida"
       name="num_vuelo_ida"
       placeholder="Ej: VY6239"
       value="{{ old('num_vuelo_ida') }}"
       required>
                        </div>
                    </div>

                    {{-- HOTEL DESTINO (IDA) --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_hotel_destino" class="form-label">Hotel Destino (Ida)</label>
                            
                            {{-- LOGICA CORPORATIVA --}}
                            @if(Auth::guard('corporate')->check())
                                <input type="text" class="form-control bg-light" value="{{ $hotels->first()->nombre }}" readonly>
                                <input type="hidden" name="id_hotel_destino" value="{{ $hotels->first()->id_hotel }}">
                            @else
                                <select class="form-select" id="id_hotel_destino" name="id_hotel_destino" required>
                                    <option value="">-- Seleccione un Hotel --</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id_hotel }}" @if(old('id_hotel_destino') == $hotel->id_hotel) selected @endif>{{ $hotel->nombre }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    
                    <hr class="my-5">

                    {{-- SECCIÓN VUELTA --}}
                    <h4 class="mb-4 text-warning"><i class="fas fa-car-side"></i> VUELTA: Hotel → Aeropuerto</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_vuelo_salida" class="form-label">Día Salida</label>
                            <input type="date" class="form-control" id="fecha_vuelo_salida" name="fecha_vuelo_salida" value="{{ old('fecha_vuelo_salida') }}" min="{{ Carbon\Carbon::parse($minDate)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
    <label for="hora_recogida_vuelta" class="form-label">Hora de Recogida</label>
    <input type="time" class="form-control"
           id="hora_recogida_vuelta"
           name="hora_recogida_vuelta"
           value="{{ old('hora_recogida_vuelta') }}"
           required>

    <small class="text-muted">Recomendado: 3-4 horas antes del vuelo.</small>

    @error('hora_recogida_vuelta')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                    </div>

                    {{-- HOTEL DE RECOGIDA --}}
<div class="col-md-6 mb-3">
    <label for="id_hotel_recogida" class="form-label">Hotel de Recogida</label>

    {{-- Caso 1: Usuario corporativo (hotel) --}}
    @if(Auth::guard('corporate')->check())
        
        {{-- MOSTRAR EL HOTEL DEL USUARIO --}}
        <input type="text" 
               class="form-control bg-light"
               value="{{ $hotels->first()->nombre }}" 
               readonly>

        <input type="hidden" 
               name="id_hotel_recogida" 
               id="id_hotel_recogida"
               value="{{ $hotels->first()->id_hotel }}">

    @else
        
         {{-- Caso 2: User web o admin → mismo hotel que destino --}}
        <input type="text"
               class="form-control bg-light"
               id="hotel_recogida_nombre"
               value="El hotel de recogida será el mismo que el de destino"
               readonly>

        <input type="hidden"
               name="id_hotel_recogida"
               id="id_hotel_recogida">
    @endif
</div>

{{-- Script para sincronizar recogida con destino cuando NO es hotel --}}
@if(!Auth::guard('corporate')->check())
<script>
document.addEventListener('DOMContentLoaded', function() {
    const destinoSelect = document.getElementById('id_hotel_destino');
    const recogidaNombre = document.getElementById('hotel_recogida_nombre');
    const recogidaHidden = document.getElementById('id_hotel_recogida');

    function syncHotel() {
        if (!destinoSelect) return;

        const option = destinoSelect.options[destinoSelect.selectedIndex];

        if (option.value === "") {
            recogidaNombre.value = "Será el mismo que el hotel de destino";
            recogidaHidden.value = "";
            return;
        }

        recogidaNombre.value = option.text;
        recogidaHidden.value = option.value;
    }

    syncHotel();

    destinoSelect.addEventListener('change', syncHotel);
});
</script>
@endif


 {{-- Selector de Vehículo y Pasajeros --}}
<h5 class="mt-4 mb-1 text-primary">
    <i class="fas fa-car"></i> Selecciona el Vehículo y los Pasajeros
</h5>

<p class="text-muted mb-3" style="font-size: 0.9rem;">
    Asignaremos uno o más vehículos del modelo que escojas según el número de pasajeros.
</p>

{{-- Vehículo --}}
<div class="mb-3">
    <label for="id_vehiculo" class="form-label">Vehículo</label>
    <select class="form-select @error('id_vehiculo') is-invalid @enderror"
            name="id_vehiculo"
            id="id_vehiculo"
            required>
        <option value="">-- Seleccione un vehículo --</option>
        @foreach($vehiculos as $vehiculo)
            <option value="{{ $vehiculo->id_vehiculo }}">
                {{ $vehiculo->descripcion }} — {{ $vehiculo->Precio }} €
            </option>
        @endforeach
    </select>

    @error('id_vehiculo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Número de pasajeros --}}
<div class="mb-3">
    <label for="pax" class="form-label">Número de Pasajeros</label>
    <input type="number"
           class="form-control @error('pax') is-invalid @enderror"
           id="pax"
           name="pax"
           value="{{ old('pax', 1) }}"
           min="1"
           required>
    @error('pax')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


                    {{-- 4. Datos Personales --}}
                    <h5 class="mt-4 mb-3 text-primary"><i class="fas fa-user"></i> Datos del Contacto</h5>
                    @php
    // Por defecto, si hay errores anteriores, mantenerlos
    $nombre = old('nombre_contacto');
    $email = old('email_contacto');

    // Si es un viajero web, sí rellenamos automáticamente
    if (Auth::guard('web')->check()) {
        $u = Auth::guard('web')->user();
        $nombre = $u->nombre . ' ' . ($u->apellido1 ?? '');
        $email = $u->email_viajero;
    }

    // Si es hotel o admin, NO rellenamos nada.
    // Los datos deben ser siempre los del viajero seleccionado.
@endphp


                    @if(Auth::guard('corporate')->check() || Auth::guard('admin')->check())
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="id_viajero" class="form-label">Asignar reserva al viajero</label>
            <select name="id_viajero" id="id_viajero" class="form-select @error('id_viajero') is-invalid @enderror" required>
                <option value="">-- Seleccione un viajero --</option>
                @foreach($viajeros as $v)
                    <option value="{{ $v->id_viajero }}">{{ $v->nombre }} {{ $v->apellido1 }} — {{ $v->email_viajero }}</option>
                @endforeach
            </select>
            @error('id_viajero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endif

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="nombre_contacto" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="{{ $nombre }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email_contacto" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_contacto" name="email_contacto" value="{{ $email }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- CAMBIO: Redirige a la ruta 'dashboard' que gestiona la redirección según el rol --}}
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-lg">Confirmar Reserva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection