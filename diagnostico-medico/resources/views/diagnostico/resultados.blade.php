@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-primario-inicio: #0056b3;
        --color-primario-fin: #007bff;
        --color-secundario-inicio: #ffcc00;
        --color-secundario-fin: #ffe680;
        --color-fondo-inicio: #e0f7fa;
        --color-fondo-fin: #f0f4ff;
        --color-texto: #333;
        --color-exito-inicio: #43cea2;
        --color-exito-fin: #185a9d;
        --color-alerta-inicio: #ff6e7f;
        --color-alerta-fin: #bfe9ff;
        --sombra-suave: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(to bottom right, var(--color-fondo-inicio), var(--color-fondo-fin));
        color: var(--color-texto);
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        font-weight: 600;
        margin-bottom: 20px;
    }

    .card {
        box-shadow: var(--sombra-suave);
        border-radius: 8px;
        transition: transform 0.3s ease-in-out;
        border-left: 5px solid var(--color-primario-inicio);
        background: linear-gradient(to right, #eed0d0ff, #2913ecff);
    }

    .card:hover {
        transform: scale(1.02);
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: bold;
    }

    .alert-success {
        background: linear-gradient(to right, var(--color-exito-inicio), var(--color-exito-fin));
        color: #f4e8e8ff;
        border: none;
        font-size: 1.1rem;
    }

    .alert-warning {
        background: linear-gradient(to right, var(--color-alerta-inicio), var(--color-alerta-fin));
        color: #e61919ff;
        border: none;
        font-size: 1.1rem;
    }

    .alert-info {
        background: linear-gradient(to right, #89f7fe, #66a6ff);
        color: #000;
        border: none;
        font-size: 1rem;
    }

    .volver-btn {
        margin-top: 30px;
    }

    .volver-btn a {
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.3s ease;
        background: linear-gradient(to right, var(--color-primario-inicio), var(--color-primario-fin));
        color: #eadcdcff;
        display: inline-block;
    }

    .volver-btn a:hover {
        background: linear-gradient(to right, #003d80, #0056b3);
    }

    footer {
        margin-top: 40px;
        font-size: 0.9rem;
        color: #666;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center text-info">🔍 Resultados del Diagnóstico</h2>

    {{-- Mostrar síntomas seleccionados --}}
    @if(!empty($sintomasSeleccionados))
        <div class="alert alert-info text-center">
            <strong>Síntomas seleccionados:</strong>
            {{ implode(', ', $sintomasSeleccionados) }}
        </div>
    @endif

    {{-- Panel explicativo si se seleccionó "dolor muscular" --}}
    @if(in_array('dolor muscular', $sintomasSeleccionados))
        <div class="alert alert-info mt-3">
            <strong>🔍 Información adicional sobre "Dolor muscular":</strong><br>
            El dolor muscular puede estar asociado a infecciones virales como gripe o dengue, sobreesfuerzo físico, estrés, o enfermedades como fibromialgia. Si se acompaña de fiebre, fatiga o dolor de cabeza, podría indicar una condición sistémica.
        </div>
    @endif

    {{-- Resultados principales --}}
    @if(!empty($resultados))
        @foreach($resultados as $resultado)
            @if(is_array($resultado))
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title text-primary">🦠 {{ $resultado['nombre'] }}</h5>
                        <p class="card-text">{{ $resultado['descripcion'] }}</p>
                        <p><strong>🧩 Síntomas coincidentes:</strong> {{ $resultado['coincidencias'] }}</p>
                    </div>
                </div>
            @else
                <div class="alert alert-success mt-4 text-center">
                    {{ $resultado }}
                </div>
            @endif
        @endforeach
    @endif

    {{-- Sugerencias si no hay coincidencias exactas --}}
    @if(empty($resultados) && !empty($sugerencias))
        <h4 class="text-center text-warning mt-4">🔎 Sugerencias basadas en coincidencias parciales</h4>
        @foreach($sugerencias as $sugerencia)
            <div class="card mt-3 border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">🧠 {{ $sugerencia['nombre'] }}</h5>
                    <p class="card-text">{{ $sugerencia['descripcion'] }}</p>
                    <p><strong>Coincidencia parcial:</strong> {{ $sugerencia['coincidencias'] }}</p>
                </div>
            </div>
        @endforeach
    @endif

    {{-- Panel educativo si no se detecta enfermedad pero hay síntomas --}}
    @if(empty($resultados) && empty($sugerencias) && !empty($sintomasSeleccionados))
        <div class="alert alert-info mt-4">
            <strong>ℹ️ No se detectó ninguna enfermedad, pero los síntomas seleccionados podrían estar relacionados con:</strong>
            <ul class="mt-2">
                @foreach($sintomasSeleccionados as $sintoma)
                    <li>{{ ucfirst($sintoma) }}: 
                        @switch($sintoma)
                            @case('fiebre') infección o inflamación general @break
                            @case('diarrea') trastornos digestivos o infecciones intestinales @break
                            @case('dolor muscular') esfuerzo físico, gripe o estrés @break
                            @case('mareos') presión baja, deshidratación o ansiedad @break
                            @case('dolor de cabeza') migraña, tensión o fiebre @break
                            @default condición leve o inespecífica
                        @endswitch
                    </li>
                @endforeach
            </ul>
            <p class="mt-3">Si los síntomas persisten o se agravan, se recomienda consultar con un profesional médico.</p>
        </div>
    @endif

    {{-- Mensaje si no hay resultados ni sugerencias --}}
    @if(empty($resultados) && empty($sugerencias))
        <div class="alert alert-warning mt-4 text-center">
            No se detectó ninguna enfermedad. Intenta con otros síntomas.
        </div>
    @endif

    <div class="text-center volver-btn">
        <a href="/diagnostico">🔙 Volver al Diagnóstico</a>
    </div>

    <footer class="text-center mt-5 text-muted small">
        
    </footer>
</div>
@endsection
