@extends('layouts.app')

@section('titulo', 'Editar Cita')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primario text-white">
                <h4 class="mb-0">Editar Cita #{{ $cita['id'] }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('citas.update', $cita['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('citas._form', ['textoBoton' => 'Actualizar Cita'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection