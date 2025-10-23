<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\LoginController;

// 🔐 Login institucional (nombre + DNI)
Route::get('/login', [LoginController::class, 'formulario'])->name('login.formulario');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');

// 🏠 Panel post-login (usa sesión, no Auth)
Route::get('/dashboard', function () {
    // Verifica si hay sesión activa
    if (!session()->has('usuario_nombre') || !session()->has('usuario_dni')) {
        return redirect()->route('login.formulario')->with('error', 'Debes iniciar sesión primero.');
    }

    return view('dashboard');
})->name('dashboard');

// 🔚 Cierre de sesión (modo libre)
Route::post('/logout', function () {
    session()->flush(); // Elimina nombre y DNI
    return redirect('/login');
})->name('logout');

// 🩺 Diagnóstico médico
Route::get('/diagnostico', [DiagnosticoController::class, 'index'])->name('diagnostico.index');
Route::post('/diagnostico', [DiagnosticoController::class, 'detectar'])->name('diagnostico.tradicional');
Route::post('/diagnostico-ia', [DiagnosticoController::class, 'detectarIA'])->name('diagnostico.ia');
