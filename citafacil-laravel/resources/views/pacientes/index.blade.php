@extends('layouts.app')

@section('titulo', 'Pacientes')

@section('contenido')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 mb-0">Pacientes</h1>
        <a href="{{ route('pacientes.create') }}" class="btn btn-primario">
            <i class="bi bi-person-plus me-1" aria-hidden="true"></i>Nuevo paciente
        </a>
    </div>

    <form method="GET" action="{{ route('pacientes.index') }}" class="row g-2 mb-4">
        <div class="col-sm-8 col-md-6 col-lg-5">
            <div class="input-group">
                <input
                    type="search"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar paciente por nombre..."
                    value="{{ $buscar }}"
                    aria-label="Buscar paciente por nombre"
                >
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search me-1" aria-hidden="true"></i>Buscar
                </button>
                @if ($buscar)
                    <a href="{{ route('pacientes.index') }}" class="btn btn-outline-danger" title="Limpiar búsqueda">
                        Limpiar
                    </a>
                @endif
            </div>
        </div>
    </form>

    @if ($pacientes->isEmpty())
        <div class="alert alert-info">
            {{ $buscar ? 'No se encontraron pacientes que coincidan con "' . $buscar . '".' : 'Aún no hay pacientes registrados.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha de nacimiento</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td class="fw-semibold">{{ $paciente->nombre }}</td>
                            <td>{{ $paciente->telefono }}</td>
                            <td>{{ $paciente->email ?? '—' }}</td>
                            <td>{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('d/m/Y') : '—' }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-sm btn-outline-secondary">
                                    Ver
                                </a>
                                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEliminarPaciente{{ $paciente->id }}"
                                >
                                    Eliminar
                                </button>

                                <x-modal-eliminar
                                    :id-modal="'modalEliminarPaciente' . $paciente->id"
                                    :ruta-accion="route('pacientes.destroy', $paciente)"
                                    titulo="Eliminar paciente"
                                >
                                    ¿Seguro que deseas eliminar al paciente <strong>{{ $paciente->nombre }}</strong>? Esta acción no se puede deshacer.
                                </x-modal-eliminar>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-paginacion :coleccion="$pacientes" />
    @endif
@endsection