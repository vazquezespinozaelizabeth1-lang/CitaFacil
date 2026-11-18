@extends('layouts.app')

@section('titulo', 'Detalle del recordatorio')

@section('contenido')
    <h1 class="h3 mb-3">Detalle del recordatorio</h1>
    <div class="card col-lg-8">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Paciente</dt>
                <dd class="col-sm-8 text-break">{{ $recordatorio->cita->paciente->nombre }}</dd>
                <dt class="col-sm-4">Cita</dt>
                <dd class="col-sm-8 text-break">
                    {{ $recordatorio->cita->fecha->format('d/m/Y') }} a las {{ $recordatorio->cita->hora }}
                    · {{ $recordatorio->cita->servicio->nombre }}
                </dd>
                <dt class="col-sm-4">Mensaje</dt>
                <dd class="col-sm-8 text-break">{{ $recordatorio->mensaje }}</dd>
                <dt class="col-sm-4">Canal</dt>
                <dd class="col-sm-8">@include('recordatorios._canal', ['canal' => $recordatorio->canal])</dd>
                <dt class="col-sm-4">Fecha y hora de envío</dt>
                <dd class="col-sm-8">{{ $recordatorio->fecha_envio->format('d/m/Y H:i') }}</dd>
                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8">@include('recordatorios._estado')</dd>
            </dl>
        </div>
        <div class="card-footer d-flex flex-wrap gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('recordatorios.index') }}">Volver</a>
            <a class="btn btn-primario" href="{{ route('recordatorios.edit', $recordatorio) }}">Editar</a>
        </div>
    </div>
@endsection
