@if (session('exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('exito') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>Revisa el formulario:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif