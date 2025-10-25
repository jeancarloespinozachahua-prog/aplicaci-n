<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\LoginController;

// 🔓 Acceso libre (solo nombre y DNI)
Route::get('/login', [LoginController::class, 'formulario'])->name('login.formulario');
Route::post('/login-libre', [LoginController::class, 'accesoLibre'])->name('login.libre');

// 🔚 Cierre de sesión usando método del controlador
Route::get('/logout', [LoginController::class, 'salir'])->name('logout');

// 🏠 Panel post-login (usa sesión, no Auth)
Route::get('/dashboard', function () {
    if (!session()->has('usuario_nombre') || !session()->has('usuario_dni')) {
        return redirect()->route('login.formulario')->with('error', 'Debes iniciar sesión primero.');
    }

    return view('dashboard');
})->name('dashboard');

// 🩺 Diagnóstico médico
Route::get('/diagnostico', [DiagnosticoController::class, 'index'])->name('diagnostico.index');
Route::post('/diagnostico', [DiagnosticoController::class, 'detectar'])->name('diagnostico.tradicional');
Route::post('/diagnostico-ia', [DiagnosticoController::class, 'detectarIA'])->name('diagnostico.ia');
