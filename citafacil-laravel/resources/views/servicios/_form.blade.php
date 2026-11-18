<div class="mb-3">
    <label for="nombre" class="form-label">Nombre <span class="text-danger" aria-hidden="true">*</span></label>
    <input type="text" id="nombre" name="nombre" maxlength="100" required
           class="form-control @error('nombre') is-invalid @enderror"
           value="{{ old('nombre', $servicio->nombre ?? '') }}">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="3" maxlength="255"
              class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="duracion_min" class="form-label">Duración (minutos) <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="number" id="duracion_min" name="duracion_min" min="5" max="480" step="5" required
               class="form-control @error('duracion_min') is-invalid @enderror"
               value="{{ old('duracion_min', $servicio->duracion_min ?? 30) }}">
        @error('duracion_min')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="precio" class="form-label">Precio (MXN) <span class="text-danger" aria-hidden="true">*</span></label>
        <input type="number" id="precio" name="precio" min="0" step="0.01" required
               class="form-control @error('precio') is-invalid @enderror"
               value="{{ old('precio', $servicio->precio ?? '0.00') }}">
        @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-check form-switch mb-4">
    <input type="checkbox" id="activo" name="activo" value="1" class="form-check-input"
           @checked(old('activo', $servicio->activo ?? true))>
    <label for="activo" class="form-check-label">Servicio activo</label>
</div>

<button type="submit" class="btn btn-primary">{{ $textoBoton }}</button>
<a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
