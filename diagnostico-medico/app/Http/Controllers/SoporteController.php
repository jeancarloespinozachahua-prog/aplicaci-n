<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SolicitudSoporte;

class SoporteController extends Controller
{
    /**
     * Muestra las solicitudes del usuario actual por su DNI.
     */
    public function mostrar()
    {
        $dni = session('usuario_dni');

        if (!$dni) {
            return redirect()->route('login.formulario')->with('error', 'Sesión inválida. Por favor, vuelve a iniciar sesión.');
        }

        $solicitudes = SolicitudSoporte::where('dni', $dni)->latest()->get();

        return view('configuracion.soporte', compact('solicitudes'));
    }

    /**
     * Guarda una nueva solicitud de soporte.
     */
    public function enviar(Request $request)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'archivo' => 'nullable|file|max:2048',
        ]);

        $nombre = session('usuario_nombre');
        $dni = session('usuario_dni');

        if (!$nombre || !$dni) {
            \Log::warning('Sesión inválida al enviar soporte', [
                'nombre' => $nombre,
                'dni' => $dni,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('login.formulario')->with('error', 'Sesión inválida. Por favor, vuelve a iniciar sesión.');
        }

        $archivoRuta = null;
        if ($request->hasFile('archivo')) {
            $archivoRuta = $request->file('archivo')->store('soporte', 'public');
        }

        \App\Models\SolicitudSoporte::create([
            'nombre' => $nombre,
            'dni' => $dni,
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
            'archivo' => $archivoRuta,
            'estado' => 'pendiente',
        ]);

        return redirect()->back()->with('success', 'Tu mensaje fue enviado correctamente.');
    }
}
