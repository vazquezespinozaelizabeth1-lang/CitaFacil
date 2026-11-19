<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/citas');

// ---- Autenticación (T05) ----
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---- Rutas protegidas (T12) ----
Route::middleware('auth')->group(function () {

    // Solo admin: crear, editar y eliminar. Va ANTES de index/show.
    Route::middleware('role:admin')->group(function () {
        Route::resource('servicios', ServicioController::class)->except(['index', 'show']);
        Route::resource('horarios', HorarioController::class)->except(['index', 'show']);
        Route::resource('recordatorios', RecordatorioController::class)->except(['index', 'show']);
    });

    // Consulta para admin y recepción
    Route::resource('servicios', ServicioController::class)->only(['index', 'show']);
    Route::resource('horarios', HorarioController::class)->only('index');
    Route::resource('recordatorios', RecordatorioController::class)->only(['index', 'show']);

    Route::resource('citas', CitaController::class);
    Route::resource('pacientes', PacienteController::class);

    // Route::get('/panel', PanelController::class)->name('panel');  // Aram (T11)
});