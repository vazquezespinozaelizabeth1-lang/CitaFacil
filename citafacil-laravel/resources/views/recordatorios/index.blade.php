@extends('layouts.app')

@section('titulo', 'Recordatorios')

@section('contenido')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <h1 class="h3 mb-0">Recordatorios</h1>
        <a class="btn btn-primario" href="{{ route('recordatorios.create') }}">Nuevo recordatorio</a>
    </div>

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
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('recordatorios.edit', $recordatorio) }}"
                       aria-label="Editar recordatorio {{ $recordatorio->id }}">
                        <i class="bi bi-pencil" aria-hidden="true"></i>
                    </a>
                </div>
            </article>
        @empty
            <x-alerta tipo="info" :descartable="false">No hay recordatorios para mostrar.</x-alerta>
        @endforelse
    </div>
@endsection
