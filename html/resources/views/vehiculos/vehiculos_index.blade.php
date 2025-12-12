@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Listado de Vehículos</h2>

    <a href="{{ route('admin.vehiculos.create') }}" class="btn btn-primary mb-3">
        Añadir Vehículo
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Email Conductor</th>
                <th>Matrícula</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($vehiculos as $v)
                <tr>
                    <td>{{ $v->id_vehiculo }}</td>
                    <td>{{ $v->descripcion }}</td>
                    <td>{{ $v->email_conductor }}</td>
                    <td>{{ $v->password }}</td>
                    <td>
                        @if($v->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inhabilitado</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.vehiculos.edit', $v->id_vehiculo) }}" class="btn btn-sm btn-warning">
                            Editar
                        </a>

                        @if($v->activo)
                            <form method="POST" action="{{ route('admin.vehiculos.disable', $v->id_vehiculo) }}" style="display:inline-block">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-warning btn-sm">Inhabilitar</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.vehiculos.enable', $v->id_vehiculo) }}" style="display:inline-block">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success btn-sm">Habilitar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
