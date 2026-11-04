<?php

use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/citas');
Route::resource('citas', CitaController::class);