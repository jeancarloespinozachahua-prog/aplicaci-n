@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ffebee, #e3f2fd);
        font-family: 'Segoe UI', sans-serif;
    }

    .urgencia-card {
        background: #fff;
        border-left: 6px solid #d32f2f;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 30px;
        max-width: 700px;
        margin: 60px auto;
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 10px rgba(211,47,47,0.4); }
        50% { box-shadow: 0 0 20px rgba(211,47,47,0.6); }
        100% { box-shadow: 0 0 10px rgba(211,47,47,0.4); }
    }

    .urgencia-card h2 {
        color: #d32f2f;
        font-weight: bold;
    }

    .urgencia-card ul {
        list-style: none;
        padding-left: 0;
    }

    .urgencia-card li::before {
        content: "⚠️ ";
        margin-right: 5px;
    }

    .btn-accion {
        margin-top: 20px;
        font-weight: bold;
    }
</style>

<div class="urgencia-card">
    @if($urgente)
        <h2>🚨 Urgencia detectada</h2>
        <p>Se han identificado síntomas que requieren atención médica inmediata:</p>
        <ul>
            @foreach($sintomas as $sintoma)
                <li>{{ ucfirst($sintoma) }}</li>
            @endforeach
        </ul>
        <p class="mt-3">Recomendamos acudir al centro médico más cercano o contactar con un profesional de salud.</p>
        <a href="{{ route('soporte') }}" class="btn btn-danger btn-accion">📞 Contactar soporte</a>
    @else
        <h2>✅ Sin urgencia crítica</h2>
        <p>Los síntomas seleccionados no indican una emergencia inmediata.</p>
        <a href="{{ route('diagnostico.index') }}" class="btn btn-primary btn-accion">🔍 Volver al diagnóstico</a>
    @endif
</div>
@endsection
