@extends('layouts.app')

@section('titulo', 'Acceso denegado')

@section('contenido')
<div class="text-center py-5">
    <h1 class="display-5 text-danger">403</h1>
    <p class="lead">No tienes permisos para acceder a esta sección.</p>
    <a href="{{ url('/') }}" class="btn btn-primario">Volver al inicio</a>
</div>
@endsection