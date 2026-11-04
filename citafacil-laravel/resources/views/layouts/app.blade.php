<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Citas') | CitaFácil</title>
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/citafacil.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg" aria-label="Menú principal">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('citas.index') }}">
            <img src="{{ asset('img/logo-app.png') }}" alt="Logo de CitaFácil" width="30" height="30" class="me-2">CitaFácil
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('citas.index') }}">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('citas.create') }}">Nueva cita</a></li>
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">
    @include('partials.alertas')
    @yield('contenido')
</main>
<footer class="container py-3 text-center small">CitaFácil · Tu tiempo también importa</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>