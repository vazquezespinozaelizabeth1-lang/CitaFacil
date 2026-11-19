<div class="mb-3">
    <label for="nombre" class="form-label">Nombre completo <span class="text-danger">*</span></label>
    <input
        type="text"
        class="form-control @error('nombre') is-invalid @enderror"
        id="nombre"
        name="nombre"
        value="{{ old('nombre', $paciente->nombre ?? '') }}"
        maxlength="100"
        required
    >
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Teléfono (10 dígitos) <span class="text-danger">*</span></label>
    <input
        type="tel"
        class="form-control @error('telefono') is-invalid @enderror"
        id="telefono"
        name="telefono"
        value="{{ old('telefono', $paciente->telefono ?? '') }}"
        maxlength="10"
        inputmode="numeric"
        required
    >
    @error('telefono')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Correo electrónico</label>
    <input
        type="email"
        class="form-control @error('email') is-invalid @enderror"
        id="email"
        name="email"
        value="{{ old('email', $paciente->email ?? '') }}"
        maxlength="100"
    >
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
    <input
        type="date"
        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
        id="fecha_nacimiento"
        name="fecha_nacimiento"
        value="{{ old('fecha_nacimiento', isset($paciente->fecha_nacimiento) ? $paciente->fecha_nacimiento->format('Y-m-d') : '') }}"
        max="{{ now()->subDay()->format('Y-m-d') }}"
    >
    @error('fecha_nacimiento')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>