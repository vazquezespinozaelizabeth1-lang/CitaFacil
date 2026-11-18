@extends('layouts.app')

@section('titulo', 'Servicios')

@section('contenido')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Servicios</h1>
        <a href="{{ route('servicios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Nuevo servicio
        </a>
    </div>

    <form method="GET" action="{{ route('servicios.index') }}" class="row g-2 mb-3" role="search">
        <div class="col-sm-8 col-md-6">
            <label for="q" class="visually-hidden">Buscar servicio</label>
            <input type="search" id="q" name="q" class="form-control" placeholder="Buscar por nombre" value="{{ request('q') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
            @if (request('q'))
                <a href="{{ route('servicios.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            @endif
        </div>
    </form>

    @if ($servicios->isEmpty())
        <x-alerta tipo="info" :descartable="false">
            {{ request('q') ? 'No se encontraron servicios con esa búsqueda.' : 'Todavía no hay servicios registrados.' }}
        </x-alerta>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->descripcion ?? '—' }}</td>
                            <td>{{ $servicio->duracion_min }} min</td>
                            <td>${{ number_format($servicio->precio, 2) }}</td>
                            <td>
                                <span class="badge text-bg-{{ $servicio->activo ? 'success' : 'secondary' }}">
                                    {{ $servicio->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm btn-outline-primary" aria-label="Editar {{ $servicio->nombre }}">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-servicio-{{ $servicio->id }}" aria-label="Eliminar {{ $servicio->nombre }}">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                                <x-modal-eliminar :idModal="'modal-servicio-'.$servicio->id"
                                                  :rutaAccion="route('servicios.destroy', $servicio)">
                                    ¿Eliminar el servicio <strong>{{ $servicio->nombre }}</strong>? Esta acción no se puede deshacer.
                                    @if ($servicio->citas_count > 0)
                                        <div class="alert alert-warning mt-3 mb-0">
                                            Tiene {{ $servicio->citas_count }} cita(s) asociada(s), por lo que no podrá eliminarse.
                                        </div>
                                    @endif
                                </x-modal-eliminar>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-paginacion :coleccion="$servicios" />
    @endif
@endsection
