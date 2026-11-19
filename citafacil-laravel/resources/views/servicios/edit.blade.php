@extends('layouts.app')

@section('titulo', 'Editar servicio')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Editar servicio</h1>
            </div>
            <div class="card-body">
                <p class="small text-muted">Los campos con <span class="text-danger">*</span> son obligatorios.</p>
                <form action="{{ route('servicios.update', $servicio) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    @include('servicios._form', ['textoBoton' => 'Actualizar servicio'])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
