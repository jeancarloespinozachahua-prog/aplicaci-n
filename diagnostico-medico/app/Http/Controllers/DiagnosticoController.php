<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad;

class DiagnosticoController extends Controller
{
    // 🔹 Muestra el formulario de diagnóstico
    public function index()
    {
        if (!session()->has('usuario_nombre') || !session()->has('usuario_dni')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
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

        $sintomasIngresados = is_array($sintomasRaw)
            ? array_map('trim', array_map('strtolower', $sintomasRaw))
            : array_map('trim', explode(',', strtolower($sintomasRaw)));

        $enfermedades = Enfermedad::where('nombre', 'not like', '%covid%')->get();
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

    // 🔹 Verifica si los síntomas indican urgencia médica
    public function verificarUrgencia(Request $request)
    {
        $sintomas = $request->input('sintomas', []);

        $sintomasDeUrgencia = [
            'dolor en el pecho',
            'dificultad para respirar',
            'palpitaciones',
            'fiebre',
            'mareos',
            'fatiga extrema',
        ];

        $urgente = collect($sintomas)->intersect($sintomasDeUrgencia)->count() >= 2;

        return view('diagnostico.urgencia', [
            'sintomas' => $sintomas,
            'urgente' => $urgente,
        ]);
    }
}
