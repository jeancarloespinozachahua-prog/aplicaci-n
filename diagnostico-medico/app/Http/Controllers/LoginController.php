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
        // Puedes personalizar el nombre y DNI aquí o pedirlos en el formulario
        $nombre = $request->input('nombre', 'Usuario Invitado');
        $dni = $request->input('dni', '00000000');

        session([
            'usuario_nombre' => $nombre,
            'usuario_dni' => $dni
        ]);

        // Redirige directamente al diagnóstico médico
        return redirect()->route('diagnostico.index');
    }

    /**
     * Cierra sesión.
     */
    public function salir()
    {
        session()->flush();
        return redirect()->route('login.formulario')->with('error', 'Sesión finalizada.');
    }
}
