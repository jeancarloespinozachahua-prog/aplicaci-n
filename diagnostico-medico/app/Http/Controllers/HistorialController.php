<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistorialController extends Controller
{
    public function subir(Request $request)
    {
        $request->validate([
            'historial' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        $archivo = $request->file('historial')->store('historiales', 'public');

        session(['usuario_historial_archivo' => $archivo]);

        return redirect()->back()->with('success', 'Historial clínico subido correctamente.');
    }
}
