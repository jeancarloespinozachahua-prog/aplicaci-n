@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-primario-inicio: #0056b3;
        --color-primario-fin: #007bff;
        --color-fondo-inicio: #e0f7fa;
        --color-fondo-fin: #f0f4ff;
        --color-texto: #333;
        --sombra-suave: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(to bottom right, var(--color-fondo-inicio), var(--color-fondo-fin));
        color: var(--color-texto);
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        box-shadow: var(--sombra-suave);
        border-radius: 8px;
        background: linear-gradient(to right, #f0f4ff, #e0f7fa);
        border-left: 5px solid var(--color-primario-inicio);
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: var(--color-primario-inicio);
    }

    .alert-info {
        background: linear-gradient(to right, #89f7fe, #66a6ff);
        color: #000;
        border: none;
        font-size: 1rem;
    }

    .btn-outline-primary {
        font-weight: bold;
        border-radius: 6px;
        padding: 10px 20px;
    }

    .sintoma-box {
        background: #ffffff;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 10px;
        box-shadow: var(--sombra-suave);
        border-left: 4px solid var(--color-primario-inicio);
    }

    footer {
        margin-top: 40px;
        font-size: 0.9rem;
        color: #666;
    }
</style>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="text-center card-title mb-3">🧠 Diagnóstico Médico</h3>

        <p><strong>👤 Paciente:</strong> {{ $nombre }}</p>
        <p><strong>🆔 DNI:</strong> {{ $dni }}</p>

        <div class="mb-3">
            <strong>🧩 Síntomas seleccionados:</strong>
            <ul>
                @foreach($sintomasSeleccionados as $sintoma)
                    <li>{{ ucfirst($sintoma) }}</li>
                @endforeach
            </ul>
        </div>

        <div class="alert alert-info">
    <h5 class="mb-2">🧠 Diagnóstico con IA:</h5>
    @foreach ($sintomasSeleccionados as $sintoma)
        @php
            $clave = strtolower($sintoma);
            $info = $analisisIA[$clave] ?? null;
        @endphp

        <div class="sintoma-box">
            @if ($info)
                <h5 class="text-primary">{{ $info[0] }} {{ $info[1] }}</h5>
                <p><strong>🧠 Análisis IA:</strong> {{ $info[2] }}</p>
                <p><strong>🦠 Posibles causas:</strong> {{ $info[3] }}</p>
                <p><strong>💊 Tratamiento sugerido:</strong> {{ $info[4] }}</p>
                <p><strong>🩺 Recomendación:</strong> {{ $info[5] }}</p>
            @else
                <p class="text-muted">No se encontró análisis IA para el síntoma: {{ ucfirst($sintoma) }}</p>
            @endif
        </div>
    @endforeach
</div>


        @php
            $tablaSintomas = [
                'fiebre' => ['Gripe, infección viral o bacteriana', 'Paracetamol o ibuprofeno', 'Mantener hidratación y descanso'],
                'diarrea' => ['Gastroenteritis, infección intestinal, intoxicación alimentaria', 'Suero oral, dieta blanda, evitar lácteos', 'Consultar si hay fiebre o deshidratación'],
                'dificultad para respirar' => ['Asma, bronquitis, neumonía', 'Inhalador (si es asmático), atención médica', 'Ir a urgencias si empeora'],
                'dolor en el pecho' => ['Angina, ansiedad, problema cardíaco o pulmonar', 'Emergencia médica inmediata', 'No automedicarse'],
                'náuseas' => ['Gastritis, migraña, intoxicación alimentaria', 'Domperidona, metoclopramida (solo bajo receta)', 'Evitar comidas pesadas'],
                'dolor de garganta' => ['Amigdalitis, faringitis, resfriado común', 'Ibuprofeno o pastillas para la garganta', 'Tomar líquidos tibios'],
                'ojos rojos' => ['Conjuntivitis, alergia, fatiga visual', 'Gotas oftálmicas lubricantes o antialérgicas', 'No tocar los ojos'],
                'dolor de cabeza' => ['Migraña, estrés, tensión, fiebre', 'Paracetamol o ibuprofeno', 'Descansar en lugar oscuro'],
                'congestión nasal' => ['Resfriado, rinitis, alergia', 'Descongestionantes o vapores', 'Beber agua y usar suero fisiológico'],
                'dolor muscular' => ['Gripe, esfuerzo físico, tensión muscular', 'Paracetamol o ibuprofeno', 'Reposar y masajear la zona'],
                'mareos' => ['Hipoglucemia, presión baja, deshidratación', 'Comer algo dulce, hidratarse', 'Sentarse y descansar'],
                'erupciones en la piel' => ['Alergia, dermatitis, sarampión', 'Cremas antihistamínicas o corticoides', 'No rascarse'],
                'tos' => ['Gripe, bronquitis, alergia', 'Jarabe para la tos, miel con limón', 'Evitar fumar'],
                'dolor abdominal' => ['Gastritis, colitis, gastroenteritis', 'Buscapina, dieta liviana', 'Evitar comidas grasosas'],
                'pérdida del olfato' => ['Sinusitis, congestión nasal', 'Reposo, hidratación', 'Control médico si persiste'],
                'palpitaciones' => ['Ansiedad, estrés, problema cardíaco', 'Relajación o atención médica', 'Evitar café o estimulantes'],
                'fatiga' => ['Anemia, estrés, falta de sueño', 'Multivitamínicos, descanso', 'Dormir bien y alimentarse sano'],
                'pérdida del gusto' => ['Sinusitis, alergia, congestión nasal', 'Reposo y control médico', 'Mantener higiene nasal']
            ];
        @endphp

        <div class="alert alert-info mt-4">
            <h5 class="mb-2">🧾 Tabla de síntomas, posibles enfermedades y tratamientos:</h5>

            @foreach ($sintomasSeleccionados as $sintoma)
                @php
                    $clave = strtolower($sintoma);
                    $info = $tablaSintomas[$clave] ?? null;
                @endphp

                <div class="sintoma-box">
                    <h5 class="text-primary">🩹 Síntoma: {{ ucfirst($sintoma) }}</h5>

                    @if ($info)
                        <p>
                            <strong>🦠 Posibles enfermedades:</strong> {{ $info[0] }}<br>
                            <strong>💊 Tratamiento común (informativo):</strong> {{ $info[1] }}<br>
                            <strong>🩺 Recomendaciones:</strong> {{ $info[2] }}
                        </p>
                    @else
                        <p class="text-muted">No se encontró información médica para este síntoma.</p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('diagnostico.index') }}" class="btn btn-outline-primary">🔙 Volver al diagnóstico</a>
        </div>
    </div>

    <footer class="text-center mt-5 text-muted small">
        Sistema desarrollado por Jean Carlo Espinoza Chahua © {{ date('Y') }}
    </footer>
</div>
@endsection
