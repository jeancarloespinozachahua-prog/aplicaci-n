<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\SoporteController;

// 🔐 Acceso con formulario
Route::get('/login', [LoginController::class, 'formulario'])->name('login.formulario');
Route::post('/login-libre', [LoginController::class, 'accesoLibre'])->name('login.libre'); // Puedes eliminar esta si ya no usas acceso libre

// 🔚 Cierre de sesión
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

// 🌐 Redirección raíz al login
Route::get('/', function () {
    return redirect()->route('login.formulario');
});

// 🌐 Vistas adicionales
Route::view('/configuracion', 'configuracion')->name('configuracion');
Route::view('/historial', 'historial')->name('historial');
Route::view('/cerrar', 'cerrar')->name('cerrar');

// 👤 Perfil
Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
Route::put('/perfil', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');

// ⚙️ Configuración modular
Route::get('/configuracion/nombre', [ConfiguracionController::class, 'editarNombre'])->name('configuracion.nombre');
Route::post('/configuracion/nombre', [ConfiguracionController::class, 'actualizarNombre']);

Route::get('/configuracion/idioma', [ConfiguracionController::class, 'editarIdioma'])->name('configuracion.idioma');
Route::post('/configuracion/idioma', [ConfiguracionController::class, 'actualizarIdioma']);

Route::get('/configuracion/tema', [ConfiguracionController::class, 'editarTema'])->name('configuracion.tema');
Route::post('/configuracion/tema', [ConfiguracionController::class, 'actualizarTema']);

Route::get('/configuracion/datos', [ConfiguracionController::class, 'editarDatos'])->name('configuracion.datos');
Route::post('/configuracion/datos', [ConfiguracionController::class, 'actualizarDatos']);

Route::get('/configuracion/historial', [ConfiguracionController::class, 'verHistorial'])->name('configuracion.historial');
Route::post('/configuracion/historial/subir', [HistorialController::class, 'subir'])->name('historial.subir');

Route::get('/configuracion/preferencias', [ConfiguracionController::class, 'editarPreferencias'])->name('configuracion.preferencias');
Route::post('/configuracion/preferencias', [ConfiguracionController::class, 'actualizarPreferencias']);

// 🛠️ Soporte técnico
Route::get('/soporte', function () {
    return redirect()->route('soporte.mostrar');
})->name('soporte');

Route::get('/configuracion/soporte', [SoporteController::class, 'mostrar'])->name('soporte.mostrar');
Route::post('/soporte/enviar', [SoporteController::class, 'enviar'])->name('soporte.enviar');
