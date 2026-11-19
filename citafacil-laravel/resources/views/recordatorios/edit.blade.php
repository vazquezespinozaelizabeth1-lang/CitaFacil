@extends('layouts.app')

@section('titulo', 'Editar recordatorio')

@section('contenido')
    <h1 class="h3 mb-3">Editar recordatorio</h1>
    <form action="{{ route('recordatorios.update', $recordatorio) }}" method="POST" class="bg-white border rounded p-3 p-md-4 col-lg-8">
        @csrf
        @method('PUT')
        @include('recordatorios._form')
        <button type="submit" class="btn btn-primario">Actualizar</button>
        <a class="btn btn-outline-secondary" href="{{ route('recordatorios.show', $recordatorio) }}">Cancelar</a>
    </form>
@endsection
