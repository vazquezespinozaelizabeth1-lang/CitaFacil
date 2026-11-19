@extends('layouts.app')

@section('titulo', 'Editar horario')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Editar horario</h1>
            </div>
            <div class="card-body">
                <p class="small text-muted">Los campos con <span class="text-danger">*</span> son obligatorios.</p>
                <form action="{{ route('horarios.update', $horario) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    @include('horarios._form', ['textoBoton' => 'Actualizar horario'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
