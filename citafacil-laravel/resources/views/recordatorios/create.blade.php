@extends('layouts.app')

@section('titulo', 'Nuevo recordatorio')

@section('contenido')
    <h1 class="h3 mb-3">Nuevo recordatorio</h1>
    <form action="{{ route('recordatorios.store') }}" method="POST" class="bg-white border rounded p-3 p-md-4 col-lg-8">
        @csrf
        @include('recordatorios._form')
        <button type="submit" class="btn btn-primario" @disabled($citas->isEmpty())>Guardar</button>
        <a class="btn btn-outline-secondary" href="{{ route('recordatorios.index') }}">Cancelar</a>
    </form>
@endsection
