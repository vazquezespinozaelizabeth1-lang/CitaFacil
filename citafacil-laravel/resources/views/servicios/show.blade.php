@extends('layouts.app')

@section('titulo', 'Detalle del servicio')

@section('contenido')
    <h1 class="h3 mb-3">Detalle del servicio</h1>
    <div class="card col-lg-8">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Nombre</dt>
                <dd class="col-sm-8 text-break">{{ $servicio->nombre }}</dd>
                <dt class="col-sm-4">Descripción</dt>
                <dd class="col-sm-8 text-break">{{ $servicio->descripcion ?? '—' }}</dd>
                <dt class="col-sm-4">Duración</dt>
                <dd class="col-sm-8">{{ $servicio->duracion_min }} min</dd>
                <dt class="col-sm-4">Precio</dt>
                <dd class="col-sm-8">${{ number_format($servicio->precio, 2) }}</dd>
                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8">
                    <span class="badge text-bg-{{ $servicio->activo ? 'success' : 'secondary' }}">
                        {{ $servicio->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </dd>
                <dt class="col-sm-4">Citas asociadas</dt>
                <dd class="col-sm-8">{{ $servicio->citas_count }}</dd>
            </dl>
        </div>
        <div class="card-footer d-flex flex-wrap gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('servicios.index') }}">Volver</a>
            @if (auth()->user()?->esAdmin())
                <a class="btn btn-primario" href="{{ route('servicios.edit', $servicio) }}">Editar</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#modal-servicio-{{ $servicio->id }}">
                    <i class="bi bi-trash" aria-hidden="true"></i> Eliminar
                </button>
                <x-modal-eliminar :idModal="'modal-servicio-'.$servicio->id"
                                  :rutaAccion="route('servicios.destroy', $servicio)">
                    ¿Eliminar el servicio <strong>{{ $servicio->nombre }}</strong>? Esta acción no se puede deshacer.
                    @if ($servicio->citas_count > 0)
                        <div class="alert alert-warning mt-3 mb-0">
                            Tiene {{ $servicio->citas_count }} cita(s) asociada(s), por lo que no podrá eliminarse.
                        </div>
                    @endif
                </x-modal-eliminar>
            @endif
        </div>
    </div>
@endsection