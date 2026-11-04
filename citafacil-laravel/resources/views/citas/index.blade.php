@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Citas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Nueva cita
        </a>
    </div>

    @if (count($citas) === 0)
        <div class="alert alert-info">Todavía no hay citas registradas.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Paciente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita['paciente'] }}</td>
                            <td>{{ $cita['fecha'] }}</td>
                            <td>{{ $cita['hora'] }}</td>
                            <td>{{ $cita['motivo'] }}</td>
                            <td>
                                @php
                                    $color = match ($cita['estado']) {
                                        'Confirmada' => 'success',
                                        'Cancelada' => 'danger',
                                        default => 'warning',
                                    };
                                @endphp
                                <span class="badge text-bg-{{ $color }}">{{ $cita['estado'] }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('citas.show', $cita['id']) }}" class="btn btn-sm btn-outline-secondary" aria-label="Ver cita de {{ $cita['paciente'] }}">
                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('citas.edit', $cita['id']) }}" class="btn btn-sm btn-outline-primary" aria-label="Editar cita de {{ $cita['paciente'] }}">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('citas.destroy', $cita['id']) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar la cita de {{ $cita['paciente'] }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Eliminar cita de {{ $cita['paciente'] }}">
                                        <i class="bi bi-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection