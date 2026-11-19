<div class="mb-3">
    <label for="paciente_id" class="form-label">Paciente <span class="text-danger" aria-hidden="true">*</span></label>
    <select id="paciente_id" name="paciente_id" required class="form-select @error('paciente_id') is-invalid @enderror">
        <option value="">Selecciona un paciente</option>
        @foreach ($pacientes as $paciente)
            <option value="{{ $paciente->id }}" @selected(old('paciente_id', $cita->paciente_id ?? '') == $paciente->id)>
                {{ $paciente->nombre }}
            </option>
        @endforeach
    </select>
    @error('paciente_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="servicio_id" class="form-label">Servicio <span class="text-danger" aria-hidden="true">*</span></label>
    <select id="servicio_id" name="servicio_id" required class="form-select @error('servicio_id') is-invalid @enderror">
        <option value="">Selecciona un servicio</option>
        @foreach ($servicios as $servicio)
            <option value="{{ $servicio->id }}" @selected(old('servicio_id', $cita->servicio_id ?? '') == $servicio->id)>
                {{ $servicio->nombre }} ({{ $servicio->duracion_min }} min)
            </option>
        @endforeach
    </select>
    @error('servicio_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="fecha" class="form-label">Fecha <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="date" id="fecha" name="fecha" required
               value="{{ old('fecha', isset($cita) ? $cita->fecha->format('Y-m-d') : '') }}"
               class="form-control @error('fecha') is-invalid @enderror">
        @error('fecha')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="hora" class="form-label">Hora <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="time" id="hora" name="hora" required
               value="{{ old('hora', $cita->hora ?? '') }}"
               class="form-control @error('hora') is-invalid @enderror">
        @error('hora')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="motivo" class="form-label">Motivo <span class="text-danger" aria-hidden="true">*</span></label>
    <textarea id="motivo" name="motivo" rows="3" required
              class="form-control @error('motivo') is-invalid @enderror">{{ old('motivo', $cita->motivo ?? '') }}</textarea>
    @error('motivo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado <span class="text-danger" aria-hidden="true">*</span></label>
    <select id="estado" name="estado" required class="form-select @error('estado') is-invalid @enderror">
        @foreach ($estados as $estado)
            <option value="{{ $estado }}" @selected(old('estado', $cita->estado ?? 'Pendiente') == $estado)>
                {{ $estado }}
            </option>
        @endforeach
    </select>
    @error('estado')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>