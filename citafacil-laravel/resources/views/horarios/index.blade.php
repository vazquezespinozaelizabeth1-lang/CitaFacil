@extends('layouts.app')

@section('titulo', 'Horarios')

@section('contenido')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Horarios de atención</h1>
        <a href="{{ route('horarios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Nuevo horario
        </a>
    </div>

    <form method="GET" action="{{ route('horarios.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-5">
            <label for="dia" class="visually-hidden">Filtrar por día</label>
            <select id="dia" name="dia" class="form-select">
                <option value="">Todos los días</option>
                @foreach ($dias as $numero => $nombre)
                    <option value="{{ $numero }}" @selected((string) request('dia') === (string) $numero)>{{ $nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            @if (request('dia'))
                <a href="{{ route('horarios.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            @endif
        </div>
    </form>

    @if ($horarios->isEmpty())
        <x-alerta tipo="info" :descartable="false">
            {{ request('dia') ? 'No hay horarios para ese día.' : 'Todavía no hay horarios registrados.' }}
        </x-alerta>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Día</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                        <tr>
                            <td>{{ $horario->nombre_dia }}</td>
                            <td>{{ substr($horario->hora_inicio, 0, 5) }}</td>
                            <td>{{ substr($horario->hora_fin, 0, 5) }}</td>
                            <td>
                                <span class="badge text-bg-{{ $horario->activo ? 'success' : 'secondary' }}">
                                    {{ $horario->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('horarios.edit', $horario) }}" class="btn btn-sm btn-outline-primary" aria-label="Editar horario del {{ $horario->nombre_dia }}">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-horario-{{ $horario->id }}" aria-label="Eliminar horario del {{ $horario->nombre_dia }}">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                                <x-modal-eliminar :idModal="'modal-horario-'.$horario->id"
                                                  :rutaAccion="route('horarios.destroy', $horario)">
                                    ¿Eliminar el horario del <strong>{{ $horario->nombre_dia }}</strong>
                                    de {{ substr($horario->hora_inicio, 0, 5) }} a {{ substr($horario->hora_fin, 0, 5) }}?
                                    Esta acción no se puede deshacer.
                                </x-modal-eliminar>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-paginacion :coleccion="$horarios" />
    @endif
@endsection
