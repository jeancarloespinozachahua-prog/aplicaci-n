<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EnfermoController;

// Ruta principal
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas del módulo de enfermedades (CRUD completo)
Route::resource('enfermedades', EnfermoController::class);

// Ruta personalizada para filtrar enfermedades por región
Route::get('/enfermedades/region/{region}', [EnfermoController::class, 'porRegion'])
    ->name('enfermedades.region');

// Ruta para mostrar historial de accesos (solo index)
Route::get('/logins', [LoginController::class, 'index'])
    ->name('logins.index');
