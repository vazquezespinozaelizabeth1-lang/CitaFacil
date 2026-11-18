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

// ---- Autenticación (Jonathan, T05): quita el // cuando termines ----
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
//     Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//     Route::post('/register', [AuthController::class, 'register']);
// });
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ---- Módulos: cada responsable quita el // de SU línea ----
Route::resource('citas', CitaController::class);                       // Aram (T09)

// Route::resource('pacientes', PacienteController::class);            // Liam (T06)

// Route::resource('servicios', ServicioController::class);            // Victor (T07)

Route::resource('horarios', HorarioController::class);              // Victor (T08)

// Route::resource('recordatorios', RecordatorioController::class);    // Angel (T10)

// Route::get('/panel', PanelController::class)->name('panel');       // Aram (T11)