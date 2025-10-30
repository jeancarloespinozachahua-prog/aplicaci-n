<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function editarNombre() {
        return view('configuracion.nombre');
    }

    public function actualizarNombre(Request $request) {
        session(['usuario_nombre' => $request->nombre]);
        return redirect()->route('configuracion.nombre')->with('success', 'Nombre actualizado');
    }

    public function editarIdioma() {
        return view('configuracion.idioma');
    }

    public function actualizarIdioma(Request $request) {
        session(['usuario_idioma' => $request->idioma]);
        return redirect()->route('configuracion.idioma')->with('success', 'Idioma actualizado');
    }

    public function editarTema() {
        return view('configuracion.tema');
    }

    public function actualizarTema(Request $request) {
        session(['usuario_tema' => $request->tema]);
        return redirect()->route('configuracion.tema')->with('success', 'Tema visual actualizado');
    }

    public function editarDatos() {
        return view('configuracion.datos');
    }

    public function actualizarDatos(Request $request) {
        session([
            'usuario_edad' => $request->edad,
            'usuario_peso' => $request->peso,
            'usuario_altura' => $request->altura,
        ]);
        return redirect()->route('configuracion.datos')->with('success', 'Datos personales actualizados');
    }

    public function verHistorial() {
        return view('configuracion.historial');
    }

    public function editarPreferencias() {
        return view('configuracion.preferencias');
    }

    public function actualizarPreferencias(Request $request) {
        session(['usuario_nivel_diagnostico' => $request->nivel]);
        return redirect()->route('configuracion.preferencias')->with('success', 'Preferencias guardadas');
    }
    
}
