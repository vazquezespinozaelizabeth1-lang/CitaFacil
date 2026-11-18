@props(['tipo' => 'info', 'descartable' => true])

<div {{ $attributes->merge(['class' => "alert alert-{$tipo}" . ($descartable ? ' alert-dismissible fade show' : '')]) }} role="alert">
    {{ $slot }}
    @if ($descartable)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    @endif
</div>