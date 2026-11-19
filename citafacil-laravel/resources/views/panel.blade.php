@extends('layouts.app')

@section('titulo', 'Panel')

@section('contenido')
<h1 class="mb-3">Panel</h1>
<p class="text-muted">Resumen del día. Recordatorios por enviar: {{ $recordatoriosPorEnviar }}</p>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <small>Citas de hoy</small>
            <h2>{{ $citasHoy }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <small>Citas pendientes</small>
            <h2>{{ $citasPendientes }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <small>Total de pacientes</small>
            <h2>{{ $totalPacientes }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center">
            <small>Servicios activos</small>
            <h2>{{ $serviciosActivos }}</h2>
        </div>
    </div>
</div>

<div class="mb-4">
    <a href="{{ route('citas.create') }}" class="btn btn-primario">Nueva cita</a>
    <a href="{{ route('pacientes.create') }}" class="btn btn-secondary">Nuevo paciente</a>
</div>

<h3>Próximas citas</h3>

@if ($proximasCitas->isEmpty())
    <p>No hay citas próximas.</p>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Servicio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proximasCitas as $cita)
                <tr>
                    <td>{{ $cita->fecha->format('d/m/Y') }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->paciente?->nombre }}</td>
                    <td>{{ $cita->servicio?->nombre }}</td>
                    <td>{{ $cita->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection