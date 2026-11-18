@if (session('exito'))
    <x-alerta tipo="success">
        {{ session('exito') }}
    </x-alerta>
@endif

@if (session('error'))
    <x-alerta tipo="danger">
        {{ session('error') }}
    </x-alerta>
@endif

@if (session('aviso'))
    <x-alerta tipo="warning">
        {{ session('aviso') }}
    </x-alerta>
@endif

@if (isset($errors) && $errors->any())
    <x-alerta tipo="danger" :descartable="false">
        <strong>Revisa el formulario:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alerta>
@endif