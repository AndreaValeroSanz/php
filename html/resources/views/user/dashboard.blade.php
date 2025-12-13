@extends('layouts.app')

@section('content')
<style>
    /* ====== SAME STYLE AS ADMIN DASHBOARD ====== */
    .dashboard-container {
        background: radial-gradient(circle at 50% -20%, #e0f2f1 0%, #f0fdfa 100%);
        min-height: 100vh;
        padding: 2rem 1.5rem;
        border-radius: 1rem;
    }

    .glass-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        height: 100%;
    }

    .glass-panel:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
    }

    .panel-header {
        background: rgba(248, 250, 252, 0.5);
        border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #0f766e;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin: 0;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .panel-body { padding: 1.5rem; }

    .welcome-banner {
        background: linear-gradient(135deg, #0f9f9a, #0f766e);
        border-radius: 1.25rem;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.25);
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.5rem;
    }

    .stat-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-bg-blue { background: rgba(13,110,253,.1); color:#0d6efd; }

    .stat-value { font-size: 1.8rem; font-weight: 800; }
    .stat-label { font-size: .85rem; color:#64748b; }

    .create-res-btn {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: 100%;
        padding: 1rem;
        border: 1px solid #e2e8f0;
        background: white;
        border-radius: .75rem;
        margin-bottom: .75rem;
        transition: all .2s;
        text-align: left;
    }

    .create-res-btn:hover {
        border-color: #0f9f9a;
        background: #f0fdfa;
        transform: translateX(4px);
    }

    .create-res-icon {
        width: 36px;
        height: 36px;
        background: #ccfbf1;
        color: #0f766e;
        border-radius: 50%;
        display:flex;
        align-items:center;
        justify-content:center;
    }
</style>

<div class="dashboard-container">
    {{-- WELCOME --}}
    <div class="welcome-banner">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h2 class="fw-bold mb-1">
                    {{ Auth::guard('web')->user()->nombre }} {{ Auth::guard('web')->user()->apellido1 }}
                </h2>
                <p class="mb-0 opacity-75">
                    Panel de usuario particular
                </p>
            </div>
            <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill">
                VIAJERO
            </span>
        </div>
    </div>

    {{-- STATS --}}
    <div class="row g-4 justify-content-center mb-5">
        <div class="col-md-4">
            <div class="glass-panel stat-card">
                <div class="stat-icon-wrapper stat-bg-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                    </svg>
                </div>
                <div>
                    <div class="stat-value">{{ $stats['totalReservas'] ?? 0 }}</div>
                    <div class="stat-label">Reservas Totales</div>
                </div>
            </div>
        </div>
        {{-- USER INFO --}}
        <div class="col-lg-6">
            <div class="glass-panel">
                <div class="panel-header">
                    <h5 class="panel-title">
                        Información del viajero
                    </h5>
                </div>
                <div class="panel-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            <span><strong>Email:</strong> {{ Auth::guard('web')->user()->email_viajero }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-person me-2"></i>
                            <span><strong>Nombre completo:</strong> {{ Auth::guard('web')->user()->nombre }} {{ Auth::guard('web')->user()->apellido1 }} {{ Auth::guard('web')->user()->apellido2 }}</span>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span><strong>Dirección:</strong> {{ Auth::guard('web')->user()->direccion }}, {{ Auth::guard('web')->user()->ciudad }} ({{ Auth::guard('web')->user()->codigoPostal }}), {{ Auth::guard('web')->user()->pais }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="row g-4">
        {{-- QUICK LINKS --}}
        <div class="col-12">
            <div class="glass-panel">
                <div class="panel-header">
                    <h5 class="panel-title text-center">Accesos rápidos</h5>
                </div>

                <div class="panel-body">

                    {{-- Primera fila --}}
                    <div class="row g-3 mb-3">
                        <div class="col-6 d-grid">
                            <a href="{{ route('transfer.select-type') }}" class="btn btn-outline-info py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                                <span class="fw-bold mt-2 d-block">Reservar Nuevo Traslado</span>
                            </a>
                        </div>
                        <div class="col-6 d-grid">
                            <a href="{{ route('mis_reservas') }}" class="btn btn-outline-primary py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                                <span class="fw-bold mt-2 d-block">Mis Reservas</span>
                            </a>
                        </div>
                    </div>

                    {{-- Segunda fila --}}
                    <div class="row g-3">
                        <div class="col-6 d-grid">
                            <a href="{{ route('calendar.index') }}" class="btn btn-outline-success py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="fw-bold mt-2 d-block">Calendario</span>
                            </a>
                        </div>
                        <div class="col-6 d-grid">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="fw-bold mt-2 d-block">Editar Perfil</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
