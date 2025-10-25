<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Enfermedad;

class DiagnosticoController extends Controller
{
    // 🔹 Muestra el formulario de diagnóstico
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

    // 🔹 Diagnóstico tradicional por síntoma (excluye COVID)
    public function detectar(Request $request)
    {
        $sintomasRaw = $request->input('sintomas');

        if (is_array($sintomasRaw)) {
            $sintomasIngresados = array_map('trim', array_map('strtolower', $sintomasRaw));
        } else {
            $sintomasIngresados = array_map('trim', explode(',', strtolower($sintomasRaw)));
        }

        $enfermedades = Enfermedad::where('nombre', 'not like', '%covid%')->get(); // ❌ Excluye COVID
        $diagnosticoPorSintoma = [];

        foreach ($sintomasIngresados as $sintoma) {
            $relacionadas = [];

            foreach ($enfermedades as $enfermedad) {
                $sintomasEnfermedad = array_map('trim', explode(',', strtolower($enfermedad->sintomas)));

                if (in_array($sintoma, $sintomasEnfermedad)) {
                    $relacionadas[] = [
                        'nombre' => $enfermedad->nombre,
                        'descripcion' => $enfermedad->descripcion,
                        'medicamento' => $enfermedad->medicamento ?? 'Consultar médico'
                    ];
                }
            }

            $diagnosticoPorSintoma[] = [
                'sintoma' => ucfirst($sintoma),
                'enfermedades' => $relacionadas
            ];
        }

        return view('diagnostico.resultados', [
            'diagnosticoPorSintoma' => $diagnosticoPorSintoma,
            'sintomasSeleccionados' => $sintomasIngresados,
            'nombre' => session('usuario_nombre'),
            'dni' => session('usuario_dni')
        ]);
    }

    // 🔹 Diagnóstico por IA con formato estructurado
    public function detectarIA(Request $request)
    {
        $sintomasRaw = $request->input('sintomas');

        if (is_array($sintomasRaw)) {
            $sintomasLista = array_map('trim', $sintomasRaw);
        } else {
            $sintomasLista = array_map('trim', explode(',', $sintomasRaw));
        }

        $resultados = [];
        $apiKey = config('services.openai.key');

        if (empty($apiKey)) {
            return back()->with('error', '⚠️ La clave de OpenAI no está configurada correctamente.');
        }

        foreach ($sintomasLista as $sintoma) {
            $prompt = "Actúa como un médico clínico experto. El paciente presenta el siguiente síntoma: $sintoma. 
Responde en el siguiente formato estructurado:

🩺 Enfermedad probable: [Nombre de la enfermedad]
💊 Medicamento recomendado: [Nombre comercial o genérico]
📌 Observación clínica: [Breve nota profesional sobre el tratamiento o seguimiento]

No incluyas saludos ni explicaciones fuera de ese formato.";

            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])->timeout(30)->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Eres un médico experto en diagnóstico clínico.'],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 500
                ]);

                if ($response->failed()) {
                    $respuestaIA = "⚠️ Error en la respuesta de OpenAI: " . ($response->json()['error']['message'] ?? 'Desconocido');
                } else {
                    $respuestaIA = $response->json()['choices'][0]['message']['content'] ?? '';
                    if (empty($respuestaIA) || Str::contains($respuestaIA, ['sin respuesta', 'no se pudo'])) {
                        $respuestaIA = "No se pudo determinar una enfermedad clara para este síntoma.";
                    }
                }

                $resultados[] = [
                    'sintoma' => ucfirst($sintoma),
                    'respuesta' => $respuestaIA
                ];
            } catch (\Exception $e) {
                $resultados[] = [
                    'sintoma' => ucfirst($sintoma),
                    'respuesta' => '⚠️ Error al conectar con OpenAI: ' . $e->getMessage()
                ];
            }
        }

        return view('diagnostico.resultados', [
            'resultados' => $resultados,
            'sugerencias' => [],
            'sintomasSeleccionados' => $sintomasLista,
            'nombre' => session('usuario_nombre'),
            'dni' => session('usuario_dni')
        ]);
    }
}
