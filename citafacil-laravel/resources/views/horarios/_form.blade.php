@php
    // PostgreSQL devuelve 09:00:00; el input time necesita 09:00
    $inicio = isset($horario) ? substr($horario->hora_inicio, 0, 5) : '';
    $fin = isset($horario) ? substr($horario->hora_fin, 0, 5) : '';
@endphp

<div class="mb-3">
    <label for="dia_semana" class="form-label">Día de la semana <span class="text-danger" aria-hidden="true">*</span></label>
    <select id="dia_semana" name="dia_semana" required class="form-select @error('dia_semana') is-invalid @enderror">
        <option value="">Selecciona un día</option>
        @foreach ($dias as $numero => $nombre)
            <option value="{{ $numero }}" @selected((string) old('dia_semana', $horario->dia_semana ?? '') === (string) $numero)>{{ $nombre }}</option>
        @endforeach
    </select>
    @error('dia_semana')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="time" id="hora_inicio" name="hora_inicio" required
               class="form-control @error('hora_inicio') is-invalid @enderror"
               value="{{ old('hora_inicio', $inicio) }}">
        @error('hora_inicio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="hora_fin" class="form-label">Hora de fin <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="time" id="hora_fin" name="hora_fin" required
               class="form-control @error('hora_fin') is-invalid @enderror"
               value="{{ old('hora_fin', $fin) }}">
        @error('hora_fin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-check form-switch mb-4">
    <input type="checkbox" id="activo" name="activo" value="1" class="form-check-input"
           @checked(old('activo', $horario->activo ?? true))>
    <label for="activo" class="form-check-label">Horario activo</label>
</div>

<button type="submit" class="btn btn-primary">{{ $textoBoton }}</button>
<a href="{{ route('horarios.index') }}" class="btn btn-secondary">Cancelar</a>
