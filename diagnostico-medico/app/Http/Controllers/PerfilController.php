<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if (session('usuario_foto')) {
                Storage::disk('public')->delete(session('usuario_foto'));
            }

            $foto = $request->file('foto')->store('perfiles', 'public');
            session(['usuario_foto' => $foto]);
        }

        session(['usuario_nombre' => $request->nombre]);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }
}
