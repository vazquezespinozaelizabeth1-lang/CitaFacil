@extends('layouts.app')

@section('titulo', 'Recordatorios')

@section('contenido')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <h1 class="h3 mb-0">Recordatorios</h1>
        @if (auth()->user()?->esAdmin())
            <a class="btn btn-primario" href="{{ route('recordatorios.create') }}">Nuevo recordatorio</a>
        @endif
    </div>

    <form action="{{ route('recordatorios.index') }}" method="GET" class="row g-2 align-items-end mb-3">
        <div class="col-6 col-md-auto">
            <label for="filtro-canal" class="form-label">Canal</label>
            <select id="filtro-canal" name="canal" class="form-select">
                <option value="">Todos</option>
                @foreach (\App\Models\Recordatorio::CANALES as $opcion)
                    <option value="{{ $opcion }}" @selected($canal === $opcion)>
                        @include('recordatorios._canal', ['canal' => $opcion, 'conIcono' => false])
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-md-auto">
            <label for="filtro-enviado" class="form-label">Estado</label>
            <select id="filtro-enviado" name="enviado" class="form-select">
                <option value="">Todos</option>
                <option value="1" @selected($estado === '1')>Enviado</option>
                <option value="0" @selected($estado === '0')>Pendiente</option>
            </select>
        </div>
        <div class="col-12 col-md-auto d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primario">Filtrar</button>
            <a class="btn btn-outline-secondary" href="{{ route('recordatorios.index') }}">Limpiar filtros</a>
        </div>
    </form>

    <div class="list-group">
        @forelse ($recordatorios as $recordatorio)
            <article class="list-group-item py-3">
                <div class="row g-2 align-items-start">
                    <div class="col-12 col-lg-3 text-break">
                        <h2 class="h6 mb-1">{{ $recordatorio->cita->paciente->nombre }}</h2>
                        <div class="small">Cita · {{ $recordatorio->cita->fecha->format('d/m/Y') }} a las {{ $recordatorio->cita->hora }}</div>
                    </div>
                    <div class="col-12 col-lg-4 text-break">{{ $recordatorio->mensaje }}</div>
                    <div class="col-8 col-lg-3">
                        @include('recordatorios._canal', ['canal' => $recordatorio->canal])
                        <div class="small">Envío · {{ $recordatorio->fecha_envio->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="col-4 col-lg-2 text-end">
                        @include('recordatorios._estado')
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-end gap-2 mt-2">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('recordatorios.show', $recordatorio) }}"
                       aria-label="Consultar recordatorio {{ $recordatorio->id }}">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </a>
                    @if (auth()->user()?->esAdmin())
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('recordatorios.edit', $recordatorio) }}"
                           aria-label="Editar recordatorio {{ $recordatorio->id }}">
                            <i class="bi bi-pencil" aria-hidden="true"></i>
                        </a>
                        @include('recordatorios._eliminar', ['soloIcono' => true])
                    @endif
                </div>
            </article>
        @empty
            <x-alerta tipo="info" :descartable="false">
                {{ $canal || in_array($estado, ['0', '1'], true) ? 'No hay recordatorios que coincidan con los filtros.' : 'No hay recordatorios para mostrar.' }}
            </x-alerta>
        @endforelse
    </div>
    <x-paginacion :coleccion="$recordatorios" />
@endsection