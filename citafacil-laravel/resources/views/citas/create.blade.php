@extends('layouts.app')
@section('titulo', 'Nueva Cita')
@section('contenido')
    <h1 class="h3 mb-3">Nueva Cita</h1>

    <form action="{{ route('citas.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="paciente" class="form-label">Paciente</label>
            <input type="text" id="paciente" name="paciente" value="{{ old('paciente') }}"
                   class="form-control @error('paciente') is-invalid @enderror" required>
            @error('paciente')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}"
                       class="form-control @error('fecha') is-invalid @enderror" required>
                @error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" id="hora" name="hora" value="{{ old('hora') }}"
                       class="form-control @error('hora') is-invalid @enderror" required>
                @error('hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <textarea id="motivo" name="motivo" rows="3"
                      class="form-control @error('motivo') is-invalid @enderror" required>{{ old('motivo') }}</textarea>
            @error('motivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                @foreach ($estados as $estado)
                    <option value="{{ $estado }}" @selected(old('estado', 'Pendiente') === $estado)>{{ $estado }}</option>
                @endforeach
            </select>
            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar cita</button>
    </form>
@endsection