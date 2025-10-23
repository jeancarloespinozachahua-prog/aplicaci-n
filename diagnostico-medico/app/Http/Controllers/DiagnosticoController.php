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

        return view('diagnostico.index', [
            'nombre' => session('usuario_nombre'),
            'dni' => session('usuario_dni')
        ]);
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
            'sintomasSeleccionados' => $sintomasIngresados,
            'nombre' => session('usuario_nombre'),
            'dni' => session('usuario_dni')
        ]);
    }

    /**
     * Diagnóstico por IA usando OpenAI con manejo de errores.
     */
    public function detectarIA(Request $request)
    {
        $sintomasRaw = $request->input('sintomas');

        if (is_array($sintomasRaw)) {
            $sintomasTexto = implode(', ', array_map('trim', $sintomasRaw));
        } else {
            $sintomasTexto = trim($sintomasRaw);
        }

        $prompt = "Soy un médico experto. El paciente presenta los siguientes síntomas: $sintomasTexto. ¿Cuál podría ser el diagnóstico más probable?";

        try {
            $response = Http::withToken(config('services.openai.key'))
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Eres un médico experto en diagnóstico clínico.'],
                        ['role' => 'user', 'content' => $prompt]
                    ]
                ]);

            $respuestaIA = $response->json()['choices'][0]['message']['content'] ?? 'Sin respuesta clara';

            $resultados = [$respuestaIA];
        } catch (\Exception $e) {
            $resultados = ['⚠️ Error al conectar con OpenAI: ' . $e->getMessage()];
        }

        return view('diagnostico.resultados', [
            'resultados' => $resultados,
            'sugerencias' => [],
            'sintomasSeleccionados' => is_array($sintomasRaw) ? $sintomasRaw : explode(',', $sintomasTexto),
            'nombre' => session('usuario_nombre'),
            'dni' => session('usuario_dni')
        ]);
    }
}
