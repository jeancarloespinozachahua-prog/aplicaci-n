<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad;
use Illuminate\Support\Facades\Http;

class DiagnosticoController extends Controller
{
    /**
     * Muestra el formulario de diagnóstico solo si hay sesión activa.
     */
    public function index()
    {
        if (!session()->has('usuario_nombre') || !session()->has('usuario_dni')) {
            return redirect()->route('login.formulario')->with('error', 'Debes iniciar sesión primero.');
        }

        return view('diagnostico.index');
    }

    /**
     * Diagnóstico tradicional basado en coincidencias de síntomas.
     */
    public function detectar(Request $request)
    {
        $sintomasRaw = $request->input('sintomas');

        if (is_array($sintomasRaw)) {
            $sintomasIngresados = array_map('trim', array_map('strtolower', $sintomasRaw));
        } else {
            $sintomasIngresados = array_map('trim', explode(',', strtolower($sintomasRaw)));
        }

        $enfermedades = Enfermedad::all();
        $resultados = [];
        $sugerencias = [];

        foreach ($enfermedades as $enfermedad) {
            $sintomasEnfermedad = array_map('trim', explode(',', strtolower($enfermedad->sintomas)));
            $coincidencias = array_intersect($sintomasIngresados, $sintomasEnfermedad);

            if (count($coincidencias) >= 2) {
                $resultados[] = [
                    'nombre' => $enfermedad->nombre,
                    'descripcion' => $enfermedad->descripcion,
                    'coincidencias' => implode(', ', $coincidencias)
                ];
            } elseif (count($coincidencias) === 1) {
                $sugerencias[] = [
                    'nombre' => $enfermedad->nombre,
                    'descripcion' => $enfermedad->descripcion,
                    'coincidencias' => implode(', ', $coincidencias)
                ];
            }
        }

        return view('diagnostico.resultados', [
            'resultados' => $resultados,
            'sugerencias' => $sugerencias,
            'sintomasSeleccionados' => $sintomasIngresados
        ]);
    }

    /**
     * Diagnóstico por IA con manejo de errores de conexión.
     */
    public function detectarIA(Request $request)
    {
        $sintomasRaw = $request->input('sintomas');

        if (is_array($sintomasRaw)) {
            $sintomasTexto = implode(', ', array_map('trim', $sintomasRaw));
        } else {
            $sintomasTexto = trim($sintomasRaw);
        }

        try {
            $respuesta = Http::timeout(5)->post('http://localhost:5000/api/predict', [
                'sintomas' => $sintomasTexto
            ]);

            $resultados = [$respuesta->json()];
        } catch (\Exception $e) {
            $resultados = ['⚠️ No se pudo conectar con el motor de IA. Verifica que esté activo en el puerto 5000.'];
        }

        return view('diagnostico.resultados', [
            'resultados' => $resultados,
            'sugerencias' => [],
            'sintomasSeleccionados' => is_array($sintomasRaw) ? $sintomasRaw : explode(',', $sintomasTexto)
        ]);
    }
}
