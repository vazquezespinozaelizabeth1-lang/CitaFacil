@php
    [$etiqueta, $icono] = match ($canal) {
        'correo' => ['Correo', 'envelope'],
        'sms' => ['SMS', 'chat-text'],
        'whatsapp' => ['WhatsApp', 'whatsapp'],
        default => [$canal, 'bell'],
    };
@endphp
@if ($conIcono ?? true)
    <i class="bi bi-{{ $icono }}" aria-hidden="true"></i>
@endif
{{ $etiqueta }}
