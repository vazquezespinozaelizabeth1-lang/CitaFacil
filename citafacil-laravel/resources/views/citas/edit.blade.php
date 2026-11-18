@extends('layouts.app')

@section('titulo', 'Editar cita')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primario text-white">
                <h4 class="mb-0">Editar cita</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('citas.update', $cita) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    @include('citas._form')

                    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primario">Actualizar cita</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection