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

    .text-teal { color: #0f766e; font-weight: 700; }
    .text-gold { color: #d97706; font-weight: 700; }
    .text-success { color: #16a34a; font-weight: 700; }

    .form-select, .btn-teal {
        border-radius: 0.5rem;
    }
    .btn-teal {
        background-color: #0f766e;
        color: white;
        font-weight: 600;
        border: none;
    }
    .btn-teal:hover {
        background-color: #0f9f9a;
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid px-lg-4">
        <div class="glass-panel">
            {{-- Header --}}
            <div class="panel-header-brand">
                <h5 class="mb-0 fw-bold">
                    Comisiones de su Hotel ({{ date('F Y', mktime(0, 0, 0, $month, 1, $year)) }})
                </h5>
                <div class="badge bg-white text-teal bg-opacity-90 shadow-sm text-dark">
                    Total: {{ count($commissionReport) }}
                </div>
            </div>

            {{-- Filtro --}}
            <form method="GET" action="{{ route('corporate.comissions') }}" class="row g-3 p-3">
                <div class="col-auto">
                    <select name="month" class="form-select">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0,0,0,$i,10)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <select name="year" class="form-select">
                        @for ($i = \Carbon\Carbon::now()->year - 2; $i <= \Carbon\Carbon::now()->year + 1; $i++)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-teal">Filtrar</button>
                </div>
            </form>

            {{-- Tabla --}}
            <div class="table-responsive p-3">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Reserva</th>
                            <th>Fecha</th>
                            <th class="text-end">Precio Total</th>
                            <th class="text-end">Comisión Hotel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commissionReport as $report)
                            <tr>
                                <td>
                                    <span class="loc-code">{{ $report['localizador'] }}</span>
                                </td>
                                <td>{{ $report['fecha_reserva'] }}</td>
                                <td class="text-end text-teal">{{ number_format($report['precio_total'], 2) }} €</td>
                                <td class="text-end text-success">{{ number_format($report['comision_hotel'], 2) }} €</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No se encontraron reservas para este periodo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3"></td> {{-- Espacio vacío para alinear a la derecha --}}
                            <td class="text-end fw-bold">
                                TOTAL COMISIÓN: {{ number_format($totalComision, 2) }} €
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($commissionReport, 'links'))
                <div class="p-4 border-top">
                    {{ $commissionReport->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
