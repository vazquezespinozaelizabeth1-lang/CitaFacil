@extends('layouts.app')

@section('titulo', 'Detalle del paciente')

@section('contenido')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 mb-0">{{ $paciente->nombre }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-primario btn-sm">Editar</a>
            <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary btn-sm">Volver al listado</a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-semibold">Datos del paciente</div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nombre completo</dt>
                <dd class="col-sm-9">{{ $paciente->nombre }}</dd>

                <dt class="col-sm-3">Teléfono</dt>
                <dd class="col-sm-9">{{ $paciente->telefono }}</dd>

                <dt class="col-sm-3">Correo electrónico</dt>
                <dd class="col-sm-9">{{ $paciente->email ?? 'No registrado' }}</dd>

                <dt class="col-sm-3">Fecha de nacimiento</dt>
                <dd class="col-sm-9 mb-0">
                    {{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('d/m/Y') : 'No registrada' }}
                </dd>
            </dl>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold">
            Citas registradas ({{ $paciente->citas->count() }})
        </div>
        <div class="card-body">
            @if ($paciente->citas->isEmpty())
                <p class="text-muted mb-0">Este paciente aún no tiene citas registradas.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Servicio</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paciente->citas as $cita)
                                <tr>
                                    <td>{{ $cita->fecha?->format('d/m/Y') ?? $cita->fecha }}</td>
                                    <td>{{ $cita->hora }}</td>
                                    <td>{{ $cita->servicio->nombre ?? '—' }}</td>
                                    <td>{{ $cita->motivo }}</td>
                                    <td>
                                        <span class="badge text-bg-secondary">{{ $cita->estado }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection