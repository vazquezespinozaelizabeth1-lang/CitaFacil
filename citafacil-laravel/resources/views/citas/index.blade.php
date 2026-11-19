@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Citas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-primario">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Nueva cita
        </a>
    </div>

    <form method="GET" action="{{ route('citas.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <label for="paciente" class="visually-hidden">Paciente</label>
            <input type="search" id="paciente" name="paciente" class="form-control"
                   value="{{ request('paciente') }}" placeholder="Buscar por paciente">
        </div>
        <div class="col-md-3">
            <label for="estado" class="visually-hidden">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="">Todos los estados</option>
                @foreach (\App\Models\Cita::ESTADOS as $estado)
                    <option value="{{ $estado }}" @selected(request('estado') === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="fecha" class="visually-hidden">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ request('fecha') }}">
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    @if ($citas->isEmpty())
        <div class="alert alert-info" role="alert">
            {{ request()->hasAny(['paciente', 'estado', 'fecha']) ? 'No hay citas con esos filtros.' : 'Todavía no hay citas registradas.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Paciente</th>
                        <th scope="col">Servicio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        @php
                            $color = match ($cita->estado) {
                                'Confirmada' => 'success',
                                'Cancelada' => 'danger',
                                default => 'warning',
                            };
                        @endphp
                        <tr>
                            <td>{{ $cita->paciente->nombre }}</td>
                            <td>{{ $cita->servicio->nombre }}</td>
                            <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>{{ $cita->motivo }}</td>
                            <td><span class="badge text-bg-{{ $color }}">{{ $cita->estado }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('citas.show', $cita) }}" class="btn btn-sm btn-outline-secondary" aria-label="Ver cita de {{ $cita->paciente->nombre }}">
                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('citas.edit', $cita) }}" class="btn btn-sm btn-outline-primary" aria-label="Editar cita de {{ $cita->paciente->nombre }}">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-cita-{{ $cita->id }}"
                                        aria-label="Eliminar cita de {{ $cita->paciente->nombre }}">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                                <x-modal-eliminar :idModal="'modal-cita-'.$cita->id"
                                                  :rutaAccion="route('citas.destroy', $cita)">
                                    ¿Eliminar la cita de <strong>{{ $cita->paciente->nombre }}</strong>
                                    del {{ $cita->fecha->format('d/m/Y') }} a las {{ $cita->hora }}?
                                    También se eliminarán sus recordatorios. Esta acción no se puede deshacer.
                                </x-modal-eliminar>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-paginacion :coleccion="$citas" />
    @endif
@endsection