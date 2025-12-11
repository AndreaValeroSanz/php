@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4>Reservar Traslado: Aeropuerto → Hotel</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('transfer.reserve.confirm') }}">
                    @csrf
                    <input type="hidden" name="reservation_type" value="airport_to_hotel">

                    {{-- Bloque de errores globales (Tarifas, etc) --}}
                    @error('hotel')
                        <div class="alert alert-danger text-center" role="alert">
                            <h5 class="text-danger">¡ERROR EN LA RESERVA!</h5>
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="alert alert-warning small">
                        <i class="fas fa-clock"></i> **Nota:** La reserva debe realizarse con al menos **48 horas de antelación**. La fecha mínima es: **{{ Carbon\Carbon::parse($minDate)->format('d/m/Y') }}**.
                    </div>
                    
                    {{-- 1. Datos del Vuelo --}}
                    <h5 class="mb-3 text-primary"><i class="fas fa-plane"></i> Datos del Vuelo (Llegada)</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_llegada" class="form-label">Día de Llegada</label>
                            <input type="date" class="form-control @error('fecha_llegada') is-invalid @enderror" 
                                   id="fecha_llegada" name="fecha_llegada" 
                                   value="{{ old('fecha_llegada') }}" 
                                   min="{{ Carbon\Carbon::parse($minDate)->format('Y-m-d') }}" required>
                            @error('fecha_llegada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hora_llegada" class="form-label">Hora de Llegada Estimada</label>
                            <input type="time" class="form-control @error('hora_llegada') is-invalid @enderror" 
                                   id="hora_llegada" name="hora_llegada" 
                                   value="{{ old('hora_llegada') }}" required>
                            @error('hora_llegada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="num_vuelo" class="form-label">Número de Vuelo</label>
                            <input type="text"
       class="form-control"
       id="num_vuelo"
       name="num_vuelo"
       placeholder="Ej: VY6239"
       value="{{ old('num_vuelo') }}"
       required>
                            @error('num_vuelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="aeropuerto_origen" class="form-label">Aeropuerto de Origen</label>
                            <input type="text"
       class="form-control @error('aeropuerto_origen') is-invalid @enderror"
       id="aeropuerto_origen"
       name="aeropuerto_origen"
       placeholder="Ej: Aeropuerto de Madrid-Barajas"
       value="{{ old('aeropuerto_origen') }}"
       required>
                            @error('aeropuerto_origen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- 2. Destino y Pasajeros --}}
                    <h5 class="mt-4 mb-3 text-primary"><i class="fas fa-hotel"></i> Destino </h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_hotel_destino" class="form-label">Selección de Hotel Destino</label>
                            
                            {{-- LOGICA CORPORATIVA: Si es hotel, campo fijo. Si no, select. --}}
                            @if(Auth::guard('corporate')->check())
                                {{-- Input visible solo lectura --}}
                                <input type="text" class="form-control bg-light" 
                                       value="{{ $hotels->first()->nombre }}" readonly>
                                {{-- Input oculto con el ID --}}
                                <input type="hidden" name="id_hotel_destino" value="{{ $hotels->first()->id_hotel }}">
                            @else
                                <select class="form-select @error('id_hotel_destino') is-invalid @enderror" 
                                        id="id_hotel_destino" name="id_hotel_destino">
                                    <option value="">-- Seleccione el Hotel --</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id_hotel }}" @if(old('id_hotel_destino') == $hotel->id_hotel) selected @endif>{{ $hotel->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('id_hotel_destino')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
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

                    {{-- 3. Datos Personales --}}
                    <h5 class="mt-4 mb-3 text-primary"><i class="fas fa-user"></i> Datos del Contacto</h5>
                    
                    {{-- Lógica robusta para obtener datos según el Guard activo --}}
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
                            <input type="text" class="form-control @error('nombre_contacto') is-invalid @enderror" 
                                   id="nombre_contacto" name="nombre_contacto" value="{{ $nombre }}" required>
                            @error('nombre_contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email_contacto" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email_contacto') is-invalid @enderror" 
                                   id="email_contacto" name="email_contacto" value="{{ $email }}" required>
                            @error('email_contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                   id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                            @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        {{-- CAMBIO: Redirige al Dashboard --}}
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-lg">Confirmar Reserva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection