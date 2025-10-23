<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function formulario()
    {
        return view('auth.login');
    }

    /**
     * Procesa el login por correo y contraseña.
     */
    public function autenticar(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $usuario = Auth::user();

            // Guardar datos en sesión
            session([
                'usuario_nombre' => $usuario->name,
                'usuario_dni' => $usuario->dni
            ]);

            return redirect()->route('diagnostico.index');
        }

        return redirect()->route('login.formulario')->with('error', 'Credenciales incorrectas.');
    }

    /**
     * Muestra el formulario de registro.
     */
    public function formularioRegistro()
    {
        return view('auth.register');
    }

    /**
     * Procesa el registro de nueva cuenta.
     */
    public function guardarRegistro(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Aquí se usa bcrypt directamente
        ]);

        session([
            'usuario_nombre' => $usuario->name,
            'usuario_dni' => $usuario->dni
        ]);

        return redirect()->route('diagnostico.index');
    }
}