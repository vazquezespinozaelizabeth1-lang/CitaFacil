@if ($citas->isEmpty())
    <x-alerta tipo="warning" :descartable="false">
        Debe haber al menos una cita registrada para guardar un recordatorio.
    </x-alerta>
@endif

<div class="mb-3">
    <label for="cita_id" class="form-label">Cita *</label>
    <select id="cita_id" name="cita_id" @class(['form-select', 'is-invalid' => $errors->has('cita_id')])
            required @disabled($citas->isEmpty()) @error('cita_id') aria-describedby="error-cita" aria-invalid="true" @enderror>
        <option value="">Selecciona una cita</option>
        @foreach ($citas as $cita)
            <option value="{{ $cita->id }}" @selected((string) old('cita_id', $recordatorio->cita_id) === (string) $cita->id)>
                {{ $cita->paciente->nombre }} · {{ $cita->fecha->format('d/m/Y') }} a las {{ $cita->hora }}
            </option>
        @endforeach
    </select>
    @error('cita_id') <div id="error-cita" class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="mensaje" class="form-label">Mensaje *</label>
    <textarea id="mensaje" name="mensaje" @class(['form-control', 'is-invalid' => $errors->has('mensaje')])
              rows="4" minlength="5" maxlength="255" required
              @error('mensaje') aria-describedby="error-mensaje" aria-invalid="true" @enderror>{{ old('mensaje', $recordatorio->mensaje) }}</textarea>
    @error('mensaje') <div id="error-mensaje" class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="fecha_envio" class="form-label">Fecha y hora de envío *</label>
    <input type="datetime-local" id="fecha_envio" name="fecha_envio" @class(['form-control', 'is-invalid' => $errors->has('fecha_envio')])
           value="{{ old('fecha_envio', $recordatorio->fecha_envio?->format('Y-m-d\TH:i')) }}" required
           @error('fecha_envio') aria-describedby="error-fecha-envio" aria-invalid="true" @enderror>
    @error('fecha_envio') <div id="error-fecha-envio" class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="canal" class="form-label">Canal *</label>
    <select id="canal" name="canal" @class(['form-select', 'is-invalid' => $errors->has('canal')]) required
            @error('canal') aria-describedby="error-canal" aria-invalid="true" @enderror>
        <option value="">Selecciona un canal</option>
        @foreach (\App\Models\Recordatorio::CANALES as $canal)
            <option value="{{ $canal }}" @selected(old('canal', $recordatorio->canal) === $canal)>
                @include('recordatorios._canal', ['conIcono' => false])
            </option>
        @endforeach
    </select>
    @error('canal') <div id="error-canal" class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-check mb-3">
    <input type="hidden" name="enviado" value="0">
    <input type="checkbox" id="enviado" name="enviado" value="1"
           @class(['form-check-input', 'is-invalid' => $errors->has('enviado')])
           @checked(old('enviado', $recordatorio->enviado))
           @error('enviado') aria-describedby="error-enviado" aria-invalid="true" @enderror>
    <label for="enviado" class="form-check-label">Enviado</label>
    @error('enviado') <div id="error-enviado" class="invalid-feedback">{{ $message }}</div> @enderror
</div>
