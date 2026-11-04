@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Citas</h1>
        <a class="btn btn-primario" href="{{ route('citas.create') }}">Nueva cita</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle bg-white">
            <thead>
                <tr>
                    <th scope="col">Paciente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($citas as $cita)
                    @php
                        $color = match ($cita['estado']) {
                            'Confirmada' => 'success',
                            'Cancelada' => 'danger',
                            default => 'warning',
                        };
                    @endphp
                    <tr>
                        <td>{{ $cita['paciente'] }}</td>
                        <td>{{ $cita['fecha'] }}</td>
                        <td>{{ $cita['hora'] }}</td>
                        <td>{{ $cita['motivo'] }}</td>
                        <td><span class="badge text-bg-{{ $color }}">{{ $cita['estado'] }}</span></td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $cita['id']) }}">Ver</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('citas.edit', $cita['id']) }}">Editar</a>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $cita['id'] }}">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No hay citas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
