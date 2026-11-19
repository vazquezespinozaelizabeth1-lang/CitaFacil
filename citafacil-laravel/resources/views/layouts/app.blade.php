<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Citas') | CitaFácil</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-app.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/citafacil.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primario" data-bs-theme="dark" aria-label="Menú principal">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ Route::has('panel') ? route('panel') : url('/') }}">
            <span class="bg-white rounded-3 px-2 py-1">
                <img src="{{ asset('img/logo-app.png') }}" alt="CitaFácil" height="40">
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Alternar menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                @if (Route::has('panel'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('panel')])
                           href="{{ route('panel') }}" @if (request()->routeIs('panel')) aria-current="page" @endif>Panel</a>
                    </li>
                @endif
                @if (Route::has('citas.index'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('citas.*')])
                           href="{{ route('citas.index') }}" @if (request()->routeIs('citas.*')) aria-current="page" @endif>Citas</a>
                    </li>
                @endif
                @if (Route::has('pacientes.index'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('pacientes.*')])
                           href="{{ route('pacientes.index') }}" @if (request()->routeIs('pacientes.*')) aria-current="page" @endif>Pacientes</a>
                    </li>
                @endif
                @if (Route::has('servicios.index'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('servicios.*')])
                           href="{{ route('servicios.index') }}" @if (request()->routeIs('servicios.*')) aria-current="page" @endif>Servicios</a>
                    </li>
                @endif
                @if (Route::has('horarios.index'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('horarios.*')])
                           href="{{ route('horarios.index') }}" @if (request()->routeIs('horarios.*')) aria-current="page" @endif>Horarios</a>
                    </li>
                @endif
                @if (Route::has('recordatorios.index'))
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('recordatorios.*')])
                           href="{{ route('recordatorios.index') }}" @if (request()->routeIs('recordatorios.*')) aria-current="page" @endif>Recordatorios</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => request()->routeIs('login')])
                               href="{{ route('login') }}" @if (request()->routeIs('login')) aria-current="page" @endif>Iniciar sesión</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a @class(['nav-link', 'active' => request()->routeIs('register')])
                               href="{{ route('register') }}" @if (request()->routeIs('register')) aria-current="page" @endif>Registrarse</a>
                        </li>
                    @endif
                @endguest
                @auth
                    <li class="nav-item"><span class="navbar-text text-white text-break">{{ auth()->user()->name }}</span></li>
                    @if (Route::has('logout'))
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light">Cerrar sesión</button>
                            </form>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">
    @include('partials.alertas')
    @yield('contenido')
</main>
<footer class="container border-top py-3 text-center small">CitaFácil · {{ date('Y') }}</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
{{-- modal-eliminar (T04) --}}
</body>
</html>
