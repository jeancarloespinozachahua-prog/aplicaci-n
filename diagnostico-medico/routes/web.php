<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\LoginController;

// 🔐 Login institucional (correo + contraseña)
Route::get('/login', [LoginController::class, 'formulario'])->name('login.formulario');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login.autenticar');

// 📝 Registro de nueva cuenta
Route::get('/register', [LoginController::class, 'formularioRegistro'])->name('register.formulario');
Route::post('/register', [LoginController::class, 'guardarRegistro'])->name('register.guardar');

// 🏠 Panel post-login (usa sesión, no Auth)
Route::get('/dashboard', function () {
    if (!session()->has('usuario_nombre') || !session()->has('usuario_dni')) {
        return redirect()->route('login.formulario')->with('error', 'Debes iniciar sesión primero.');
    }

    return view('dashboard');
})->name('dashboard');

// 🔚 Cierre de sesión
Route::post('/logout', function () {
    session()->flush();
    return redirect('/login');
})->name('logout');

// 🩺 Diagnóstico médico
Route::get('/diagnostico', [DiagnosticoController::class, 'index'])->name('diagnostico.index');
Route::post('/diagnostico', [DiagnosticoController::class, 'detectar'])->name('diagnostico.tradicional');
Route::post('/diagnostico-ia', [DiagnosticoController::class, 'detectarIA'])->name('diagnostico.ia');
