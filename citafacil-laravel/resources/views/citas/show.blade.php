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

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <p class="small fw-bold text-success-emphasis text-uppercase mb-2">Tu agenda médica</p>
            <h1 class="h3 mb-2">Detalle de la cita</h1>
            <p class="text-body-secondary mb-4">Revisa los datos y el estado de esta atención.</p>

            <div class="rounded-3 shadow-sm overflow-hidden">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 py-2">
                            <h2 class="h5 mb-0 text-break">Cita de {{ $cita['paciente'] }}</h2>
                            <span class="small text-body-secondary">Cita #{{ $cita['id'] }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bg-success-subtle text-success-emphasis rounded-3 p-3 mb-4">
                            <p class="small fw-bold mb-1">Fecha y hora de tu cita</p>
                            <p class="h5 mb-0">{{ $cita['fecha'] }} <span class="fw-normal">a las</span> {{ $cita['hora'] }}</p>
                        </div>
                        <dl class="row mb-0">
                            <dt class="col-sm-3"><span class="d-block text-body-secondary fw-normal mb-1 mb-sm-3">Paciente</span></dt>
                            <dd class="col-sm-9"><span class="d-block fw-semibold text-break mb-3">{{ $cita['paciente'] }}</span></dd>
                            <dt class="col-sm-3"><span class="d-block text-body-secondary fw-normal mb-1 mb-sm-3">Fecha</span></dt>
                            <dd class="col-sm-9"><span class="d-block mb-3">{{ $cita['fecha'] }}</span></dd>
                            <dt class="col-sm-3"><span class="d-block text-body-secondary fw-normal mb-1 mb-sm-3">Hora</span></dt>
                            <dd class="col-sm-9"><span class="d-block mb-3">{{ $cita['hora'] }}</span></dd>
                            <dt class="col-sm-3"><span class="d-block text-body-secondary fw-normal mb-1 mb-sm-3">Motivo</span></dt>
                            <dd class="col-sm-9"><span class="d-block text-break mb-3">{{ $cita['motivo'] }}</span></dd>
                            <dt class="col-sm-3"><span class="text-body-secondary fw-normal">Estado</span></dt>
                            <dd class="col-sm-9"><span class="badge text-bg-{{ $color }}">{{ $cita['estado'] }}</span></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between gap-2 mt-4">
                <a class="btn btn-secondary" href="{{ route('citas.index') }}">Volver al listado</a>
                <a class="btn btn-primario" href="{{ route('citas.edit', $cita['id']) }}">Editar</a>
            </div>
        </div>
    </div>
@endsection
