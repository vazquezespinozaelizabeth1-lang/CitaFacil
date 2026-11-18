<button type="button" class="btn {{ $soloIcono ? 'btn-sm btn-outline-danger' : 'btn-outline-danger' }}"
        data-bs-toggle="modal" data-bs-target="#eliminar-recordatorio-{{ $recordatorio->id }}"
        @if ($soloIcono) aria-label="Eliminar recordatorio {{ $recordatorio->id }}" @endif>
    <i class="bi bi-trash" aria-hidden="true"></i>
    @unless ($soloIcono) Eliminar @endunless
</button>

<x-modal-eliminar :id-modal="'eliminar-recordatorio-'.$recordatorio->id"
                  :ruta-accion="route('recordatorios.destroy', $recordatorio)"
                  titulo="Eliminar recordatorio">
    <p class="mb-2">¿Eliminar el recordatorio de <strong>{{ $recordatorio->cita->paciente->nombre }}</strong>?</p>
    <p class="mb-0 text-break">{{ $recordatorio->mensaje }}</p>
</x-modal-eliminar>
