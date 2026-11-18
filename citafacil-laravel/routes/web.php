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

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // 1. Rutas de administración (crear, editar, eliminar) van PRIMERO
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('servicios', ServicioController::class)->except(['index', 'show']);
        Route::resource('horarios', HorarioController::class)->except(['index', 'show']);
    });

    // 2. Rutas de consulta pública / recepción (index y show) van DESPUÉS
    Route::resource('servicios', ServicioController::class)->only(['index', 'show']);
    Route::resource('horarios', HorarioController::class)->only(['index', 'show']);

    // Módulos generales de la aplicación
    Route::resource('citas', CitaController::class);
    Route::resource('pacientes', PacienteController::class);
    Route::resource('recordatorios', RecordatorioController::class); // Si aplica
    
    // Panel si lo tienes definido
    // Route::get('/panel', [PanelController::class, 'index'])->name('panel');
});

// ---- Módulos: cada responsable quita el // de SU línea ----
Route::resource('citas', CitaController::class);                       // Aram (T09)

Route::resource('pacientes', PacienteController::class);            // Liam (T06)

// Route::resource('servicios', ServicioController::class);            // Victor (T07)

// Route::resource('horarios', HorarioController::class);              // Victor (T08)

// Route::resource('recordatorios', RecordatorioController::class);    // Angel (T10)

// Route::get('/panel', PanelController::class)->name('panel');       // Aram (T11)