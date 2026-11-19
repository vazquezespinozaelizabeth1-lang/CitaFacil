@extends('layouts.app')

@section('titulo', 'Editar paciente')

@section('contenido')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0">Editar paciente</h1>
                <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pacientes.update', $paciente) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        @include('pacientes._form')

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('pacientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primario">Actualizar paciente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection