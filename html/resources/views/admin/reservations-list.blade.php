@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        min-height: 100vh;
        padding: 2rem 1.5rem;
    }

    .glass-panel {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        overflow: hidden;
    }

    .panel-header-brand {
        background: linear-gradient(90deg, #0f9f9a, #0f766e);
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }

    .custom-table {
        margin-bottom: 0;
        width: 100%;
        vertical-align: middle;
    }
    .custom-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem 1rem;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .custom-table tbody td {
        padding: 0.85rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #334155;
    }
    .custom-table tbody tr:hover {
        background-color: #f1f5f9;
    }
    
    .loc-code {
        font-family: monospace;
        background: #f1f5f9;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        color: #0f172a;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .text-teal { color: #0f766e; font-weight: 700; }
    .text-gold { color: #d97706; font-weight: 700; }

    .btn-back {
        color: #0f766e;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-weight: 600; margin-bottom: 1.5rem;
        transition: transform 0.2s;
    }
    .btn-back:hover { transform: translateX(-4px); color: #0d9488; }
    
    .pagination {
        margin-bottom: 0;
        justify-content: center;
    }
    .page-link {
        color: #0f766e;
        border: 1px solid #e2e8f0;
        padding: 0.5rem 0.75rem;
    }
    .page-item.active .page-link {
        background-color: #0f766e;
        border-color: #0f766e;
        color: white;
    }
    .page-link:hover {
        background-color: #f0fdfa;
        color: #0f766e;
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid px-lg-4">

        <div class="glass-panel">
            {{-- Header --}}
            <div class="panel-header-brand">
                <div class="d-flex align-items-center gap-2">
                    {{-- Icon: Clipboard --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    <h5 class="mb-0 fw-bold">Listado General de Reservas</h5>
                </div>
                <div class="badge bg-white text-teal bg-opacity-90 shadow-sm text-dark">
                    Total: {{ $reservas->total() }}
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Localizador</th>
                            <th>Tipo</th>
                            <th>Vehículo</th>
                            <th>Hotel</th>
                            <th>Zona</th>
                            <th>Fecha Traslado</th>
                            <th>Pasajeros</th>
                            <th>Precio Total</th>
                            <th>Comisión</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservas as $reserva)
                            <tr>
                                <td>
                                    <span class="loc-code">{{ $reserva->localizador }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border fw-normal">
                                        {{ $reserva->tipo_traslado_nombre }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1 text-muted">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $reserva->vehiculo->descripcion ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-teal">
                                    {{ $reserva->hotel->nombre ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $reserva->zona->descripcion ?? 'N/A' }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column" style="line-height:1.2">
                                        <span>{{ $reserva->fecha_entrada ?? 'N/A' }}</span>
                                        <small class="text-muted">{{ $reserva->hora_entrada }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-white text-dark border">{{ $reserva->num_viajeros }}</span>
                                </td>
                                <td class="text-end text-teal">
                                    <span class="text-teal">{{ number_format($reserva->precio_total, 2) }} €</span>
                                </td>
                                <td class="text-end text-gold">
                                    <span class="text-gold">+{{ number_format($reserva->comision_ganada, 2) }} €</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.reserva.detalle', $reserva->id_reserva) }}" 
                                       class="btn btn-sm btn-light text-teal fw-bold border">
                                        Ver Detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            <div class="p-4 border-top">
                {{ $reservas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection