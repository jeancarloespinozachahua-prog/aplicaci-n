<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de acceso institucional.
     */
    public function formulario()
    {
        return view('auth.login');
    }

    /**
     * Procesa el acceso con nombre y DNI (modo libre).
     * Redirige directamente al diagnóstico médico.
     */
    public function autenticar(Request $request)
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string'],
            'dni' => ['required', 'string']
        ]);

        // Guardar datos en sesión
        session([
            'usuario_nombre' => $datos['nombre'],
            'usuario_dni' => $datos['dni']
        ]);

        // Redirigir directamente al diagnóstico
        return redirect()->route('diagnostico.index');
    }
}

