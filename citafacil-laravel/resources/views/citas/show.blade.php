@extends('layouts.app')
@section('titulo', 'Detalle de la Cita')
@section('contenido')
    <h1 class="h3 mb-3">Detalle de la Cita</h1>

    @php
        $color = match ($cita['estado']) {
            'Confirmada' => 'success',
            'Cancelada' => 'danger',
            default => 'warning',
        };
    @endphp

    <div class="card mb-3">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Paciente</dt>
                <dd class="col-sm-9">{{ $cita['paciente'] }}</dd>

                <dt class="col-sm-3">Fecha</dt>
                <dd class="col-sm-9">{{ $cita['fecha'] }}</dd>

                <dt class="col-sm-3">Hora</dt>
                <dd class="col-sm-9">{{ $cita['hora'] }}</dd>

                <dt class="col-sm-3">Motivo</dt>
                <dd class="col-sm-9">{{ $cita['motivo'] }}</dd>

                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9"><span class="badge text-bg-{{ $color }}">{{ $cita['estado'] }}</span></dd>
            </dl>
        </div>
    </div>

    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver
    </a>
    <a href="{{ route('citas.edit', $cita['id']) }}" class="btn btn-primary">
        <i class="bi bi-pencil" aria-hidden="true"></i> Editar
    </a>
@endsection