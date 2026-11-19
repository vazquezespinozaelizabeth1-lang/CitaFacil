@extends('layouts.app')

@section('titulo', 'Horarios')

@section('contenido')
    @php $esAdmin = auth()->user()?->esAdmin(); @endphp

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">Horarios de atención</h1>
        @if ($esAdmin)
            <a href="{{ route('horarios.create') }}" class="btn btn-primario">
                <i class="bi bi-plus-lg" aria-hidden="true"></i> Nuevo horario
            </a>
        @endif
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
            <button type="submit" class="btn btn-outline-secondary">Filtrar</button>
            @if (request('dia'))
                <a href="{{ route('horarios.index') }}" class="btn btn-outline-danger">Limpiar</a>
            @endif
        </div>
    </form>

    @if ($porDia->isEmpty())
        <x-alerta tipo="info" :descartable="false">
            {{ request('dia') ? 'No hay horarios para ese día.' : 'Todavía no hay horarios registrados.' }}
        </x-alerta>
    @else
        <div class="row g-3">
            @foreach ($porDia as $horariosDelDia)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header fw-bold">{{ $horariosDelDia->first()->nombre_dia }}</div>
                        <ul class="list-group list-group-flush">
                            @foreach ($horariosDelDia as $horario)
                                <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center gap-2">
                                    <div>
                                        <span class="fw-semibold">{{ substr($horario->hora_inicio, 0, 5) }} – {{ substr($horario->hora_fin, 0, 5) }}</span>
                                        <span class="badge text-bg-{{ $horario->activo ? 'success' : 'secondary' }} ms-2">
                                            {{ $horario->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>

                                    @if ($esAdmin)
                                        <div class="text-nowrap">
                                            <a href="{{ route('horarios.edit', $horario) }}" class="btn btn-sm btn-outline-primary"
                                               aria-label="Editar horario del {{ $horario->nombre_dia }}">
                                                <i class="bi bi-pencil" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminarHorario{{ $horario->id }}"
                                                    aria-label="Eliminar horario del {{ $horario->nombre_dia }}">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                            </button>
                                            <x-modal-eliminar
                                                :id-modal="'modalEliminarHorario' . $horario->id"
                                                :ruta-accion="route('horarios.destroy', $horario)"
                                                titulo="Eliminar horario"
                                            >
                                                ¿Eliminar el horario del <strong>{{ $horario->nombre_dia }}</strong>
                                                de {{ substr($horario->hora_inicio, 0, 5) }} a {{ substr($horario->hora_fin, 0, 5) }}?
                                                Esta acción no se puede deshacer.
                                            </x-modal-eliminar>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

        <x-paginacion :coleccion="$horarios" />
    @endif
@endsection
