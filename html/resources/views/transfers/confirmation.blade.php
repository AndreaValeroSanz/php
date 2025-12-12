@extends('layouts.app')

@section('content')
<style>
    .dashboard-container { min-height: 100vh; padding: 2rem 1.5rem; }
    .glass-panel {
        background: rgba(255,255,255,.96);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,.6);
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(15,23,42,.06);
        overflow: hidden;
    }
    .panel-header {
        background: linear-gradient(90deg,#0f9f9a,#0f766e);
        color: white;
        padding: 1.75rem 2rem;
        text-align: center;
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid px-lg-4">
        <div class="glass-panel text-center">

            <div class="panel-header">
                <h2 class="mb-0">¡Reserva Confirmada con Éxito! 🎉</h2>
            </div>

            <div class="p-5">
                <i class="fas fa-check-circle fa-5x text-success mb-4"></i>

                <p class="lead mb-4">
                    Tu traslado ha sido reservado correctamente.<br>
                    Recibirás un correo electrónico con todos los detalles.
                </p>

                <div class="mb-4">
                    <h5 class="fw-bold text-muted">Localizador de Reserva</h5>
                    <div class="d-inline-block px-4 py-2 bg-light border rounded">
                        <span class="h4 fw-bold text-teal">{{ $localizador }}</span>
                    </div>
                </div>

                <p class="text-muted fst-italic">
                    La confirmación final con vehículo y precio se adjuntará en el correo.
                </p>

                <hr class="my-5">

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('transfer.select-type') }}" class="btn btn-confirm">
                        Nueva Reserva
                    </a>
                    <a href="#" class="btn btn-cancel">
                        Ver Mi Calendario
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection