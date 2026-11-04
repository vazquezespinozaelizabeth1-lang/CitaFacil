@extends('layouts.app')
@section('titulo', 'Citas')
@section('contenido')
    <div class="bg-white border-start border-4 border-success rounded-3 shadow-sm p-3 p-md-4 mb-4">
        <p class="small fw-bold text-success-emphasis text-uppercase mb-2">Tu agenda médica</p>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Citas</h1>
            <a class="btn btn-primario" href="{{ route('citas.create') }}">Nueva cita</a>
        </div>
        <p class="text-body-secondary mb-0">Consulta tus citas y revisa los detalles de cada atención.</p>
    </div>

    <div class="bg-white border rounded-3 shadow-sm overflow-hidden">
        <div class="px-3 px-md-4 py-3 border-bottom">
            <h2 class="h6 fw-bold mb-1">Citas registradas</h2>
            <p class="small text-body-secondary mb-0">Toda la información de tu agenda en un solo lugar.</p>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle bg-white">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="ps-3 ps-md-4 py-3">Paciente</th>
                        <th scope="col" class="py-3">Fecha</th>
                        <th scope="col" class="py-3">Hora</th>
                        <th scope="col" class="py-3">Motivo</th>
                        <th scope="col" class="py-3">Estado</th>
                        <th scope="col" class="pe-3 pe-md-4 py-3 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($citas as $cita)
                        @php
                            $color = match ($cita['estado']) {
                                'Confirmada' => 'success',
                                'Cancelada' => 'danger',
                                default => 'warning',
                            };
                        @endphp
                        <tr>
                            <td class="ps-3 ps-md-4 py-3 fw-semibold text-nowrap">{{ $cita['paciente'] }}</td>
                            <td class="py-3 text-nowrap">{{ $cita['fecha'] }}</td>
                            <td class="py-3 text-nowrap">{{ $cita['hora'] }}</td>
                            <td class="py-3 text-body-secondary">{{ $cita['motivo'] }}</td>
                            <td class="py-3"><span class="badge text-bg-{{ $color }}">{{ $cita['estado'] }}</span></td>
                            <td class="pe-3 pe-md-4 py-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $cita['id']) }}">Ver</a>
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('citas.edit', $cita['id']) }}">Editar</a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $cita['id'] }}">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No hay citas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-body-tertiary border-top px-3 px-md-4 py-3 d-md-none">
            <p class="small text-body-secondary mb-0">Desliza la tabla hacia los lados para ver todas las columnas.</p>
        </div>
    </div>

    @foreach ($citas as $cita)
        <div class="modal fade" id="modalEliminar{{ $cita['id'] }}" tabindex="-1" aria-labelledby="tituloEliminar{{ $cita['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="tituloEliminar{{ $cita['id'] }}">Eliminar cita</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que deseas eliminar la cita de <strong>{{ $cita['paciente'] }}</strong> del {{ $cita['fecha'] }} a las {{ $cita['hora'] }}? Esta acción no se puede deshacer.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('citas.destroy', $cita['id']) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
