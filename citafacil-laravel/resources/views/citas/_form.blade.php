<div class="mb-3">
    <label for="paciente" class="form-label">Paciente</label>
    <input type="text" id="paciente" name="paciente" class="form-control @error('paciente') is-invalid @enderror" value="{{ old('paciente', $cita['paciente'] ?? '') }}">
    @error('paciente')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" id="fecha" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $cita['fecha'] ?? '') }}">
    @error('fecha')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="hora" class="form-label">Hora</label>
    <input type="time" id="hora" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $cita['hora'] ?? '') }}">
    @error('hora')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="motivo" class="form-label">Motivo</label>
    <textarea rows="3" id="motivo" name="motivo" class="form-control @error('motivo') is-invalid @enderror">{{ old('motivo', $cita['motivo'] ?? '') }}</textarea>
    @error('motivo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror">
        @foreach ($estados as $estado)
            <option value="{{ $estado }}" @selected(old('estado', $cita['estado'] ?? 'Pendiente') === $estado)>{{ $estado }}</option>
        @endforeach
    </select>
    @error('estado')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primario">{{ $textoBoton }}</button>
<a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>