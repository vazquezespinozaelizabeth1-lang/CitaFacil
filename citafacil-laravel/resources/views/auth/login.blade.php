@extends('layouts.app')

@section('contenido')
<div class="container d-flex justify-content-center align-items-center min-vh-75 py-5">
    <div class="card shadow-sm w-100" style="max-width: 450px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold">Iniciar Sesión</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                            <i class="bi bi-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/password.js') }}"></script>
@endpush
@endsection