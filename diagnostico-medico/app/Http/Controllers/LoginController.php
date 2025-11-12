<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de acceso con correo y contraseña.
     */
    public function formulario()
    {
        return view('auth.login');
    }

    /**
     * Muestra el formulario de registro de cuenta.
     */
    public function registro()
    {
        return view('auth.register');
    }

    /**
     * Guarda el nuevo usuario y lo inicia sesión.
     */
    public function guardarRegistro(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        session([
            'usuario_email' => $user->email,
            'usuario_nombre' => $user->name,
            'usuario_dni' => $user->dni,
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Inicia sesión con correo y contraseña.
     */
    public function autenticar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            session([
                'usuario_email' => $request->email,
                'usuario_nombre' => Auth::user()->name ?? 'Cliente',
                'usuario_dni' => Auth::user()->dni ?? '---',
            ]);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Correo o contraseña incorrectos');
    }

    /**
     * Inicia sesión sin correo ni contraseña (modo libre).
     */
    public function accesoLibre(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dni' => 'required|string|max:20',
        ]);

        session([
            'usuario_nombre' => $request->nombre,
            'usuario_dni' => $request->dni,
        ]);

        return redirect()->route('diagnostico.index');
    }

    /**
     * Cierra sesión y muestra vista de despedida.
     */
    public function salir()
    {
        $nombre = session('usuario_nombre') ?? session('usuario_email');
        $dni = session('usuario_dni') ?? '---';

        session()->flush();

        return view('cerrar', compact('nombre', 'dni'));
    }
}
