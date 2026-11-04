@extends('layouts.app')
@section('titulo', 'Detalle de la cita')
@section('contenido')
    @php
        $color = match ($cita['estado']) {
            'Confirmada' => 'success',
            'Cancelada' => 'danger',
            default => 'warning',
        };
    @endphp

    <div class="card">
        <div class="card-header">Cita de {{ $cita['paciente'] }}</div>
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

    <div class="mt-3">
        <a class="btn btn-secondary" href="{{ route('citas.index') }}">Volver al listado</a>
        <a class="btn btn-primario" href="{{ route('citas.edit', $cita['id']) }}">Editar</a>
    </div>
@endsection
