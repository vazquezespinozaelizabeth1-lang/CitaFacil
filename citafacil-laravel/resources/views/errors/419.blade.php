@extends('layouts.app')

@section('titulo', 'Sesión expirada')

@section('contenido')
<div class="text-center py-5">
    <h1 class="display-5 text-warning">419</h1>
    <p class="lead">La página ha expirado o tu sesión ha caducado.</p>
    <a href="{{ url('/') }}" class="btn btn-primario">Volver al inicio</a>
</div>
@endsection