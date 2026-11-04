@extends('layouts.app')

@section('titulo', 'Crear Cita')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primario text-white">
                <h4 class="mb-0">Registrar Nueva Cita</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf
                    @include('citas._form', ['textoBoton' => 'Guardar Cita'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection