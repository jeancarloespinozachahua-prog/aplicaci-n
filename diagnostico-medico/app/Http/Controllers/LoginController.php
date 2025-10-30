<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de acceso libre.
     */
    public function formulario()
    {
        return view('auth.login');
    }

    /**
     * Inicia sesión sin correo ni contraseña.
     */
    public function accesoLibre(Request $request)
    {
        // Validación básica del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
        ]);

        // Guarda los datos en sesión directamente desde el formulario
        session([
            'usuario_nombre' => $request->nombre,
            'usuario_dni' => $request->dni,
        ]);

        // Redirige directamente al diagnóstico médico
        return redirect()->route('diagnostico.index');
    }

    /**
     * Cierra sesión y muestra vista de despedida con datos.
     */
    public function salir()
    {
        $nombre = session('usuario_nombre');
        $dni = session('usuario_dni');

        session()->flush();

        return view('cerrar', compact('nombre', 'dni'));
    }
}
