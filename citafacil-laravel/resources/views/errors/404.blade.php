@extends('layouts.app')
@section('titulo', 'Página no encontrada')
@section('contenido')
    <div class="text-center py-5">
        <h1 class="display-5">404</h1>
        <p class="lead">No encontramos lo que buscas.</p>
        <a href="{{ url('/') }}" class="btn btn-primario">Volver al inicio</a>
    </div>
@endsection