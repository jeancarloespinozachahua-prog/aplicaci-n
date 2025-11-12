@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-primario-inicio: #0056b3;
        --color-primario-fin: #007bff;
        --color-fondo-inicio: #58ebfeff;
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
        background: linear-gradient(to right, #5caaeeffff, #e0f7fa);
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
        <h3 class="text-center card-title mb-3">🧠 Diagnóstico Médico Con IA</h3>

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

        @php
            $tablaSintomas = [
                'fiebre' => ['Infección viral o bacteriana', 'Paracetamol 500-750 mg cada 8 h, hidratación con agua o suero', 'Si supera 39°C, se acompaña de confusión o dificultad respiratoria'],
                'diarrea' => ['Gastroenteritis, alimento en mal estado', 'Suero de rehidratación oral, dieta blanda (arroz, pollo, plátano), evitar lácteos y fritos', 'Si hay diarrea con sangre, deshidratación o más de 3 días sin mejorar'],
                'dificultad para respirar' => ['Infección pulmonar, crisis asmática', 'Sentarse, respirar lento, si tiene inhalador usarlo; no automedicar antibióticos', 'Urgente siempre. Llamar a emergencia o ir al hospital'],
                'dolor en el pecho' => ['Tensión muscular o afección cardíaca', 'Reposo, respiración lenta', 'Urgente si es fuerte, aprieta, se va al brazo o mandíbula'],
                'náuseas' => ['Gastritis o infección gastrointestinal', 'Manzanilla, jengibre natural, Omeprazol 20 mg en ayunas por 3 días', 'Si vomita sangre, no retiene líquidos, o dura >48h'],
                'dolor de garganta' => ['Amigdalitis viral o bacteriana', 'Gárgaras con agua tibia + sal, Ibuprofeno 400 mg cada 8 h', 'Si hay placas blancas, fiebre alta y dolor intenso (posible antibiótico médico)'],
                'ojos rojos' => ['Conjuntivitis o alergia', 'Lavado con suero, compresa fría, gotas lubricantes', 'Si hay secreción purulenta o dolor fuerte'],
                'dolor de cabeza' => ['Estrés, deshidratación, fiebre', 'Paracetamol o Ibuprofeno, tomar agua, descansar', 'Si es intenso y repentino o con visión borrosa'],
                'congestión nasal' => ['Resfrío o alergia', 'Vapor de eucalipto, suero nasal, Loratadina 10 mg cada 24 h', 'Si dura más de 10 días con fiebre alta'],
                'dolor muscular' => ['Infección viral o esfuerzo', 'Ibuprofeno 400 mg cada 8 h, reposo, hidratación', 'Si se acompaña de dificultad respiratoria o rigidez de cuello'],
                'mareos' => ['Presión baja, deshidratación', 'Tomar agua, comer algo salado, levantarse lento', 'Si se desmaya o visión doble'],
                'erupciones en la piel' => ['Alergia o reacción', 'Antihistamínico: Loratadina 10 mg diaria, no rascar', 'Si se acompaña de dificultad para respirar (urgente)'],
                'tos' => ['Resfrío, irritación o infección pulmonar', 'Miel tibia, jengibre, jarabe expectorante, evitar humo', 'Si hay flema con sangre o falta de aire (urgente)'],
                'dolor abdominal' => ['Indigestión, infección intestinal', 'Dieta blanda, evitar grasas, Buscapina si hay cólico', 'Si hay dolor fuerte en un solo lado o vómitos persistentes'],
                'pérdida del olfato' => ['Infecciones virales', 'Hidratación, descanso, vapor nasal', 'Si se acompaña de fiebre alta + dificultad respiratoria'],
                'pérdida del gusto' => ['Infecciones virales', 'Hidratación, descanso, vapor nasal', 'Si se acompaña de fiebre alta + dificultad respiratoria'],
                'palpitaciones' => ['Ansiedad, deshidratación', 'Respiración lenta, tomar agua, evitar café', 'Si se acompaña de dolor en el pecho o desmayo (urgente)'],
                'fatiga' => ['Falta de sueño, infección o anemia', 'Dormir 8h, hidratación, alimentación balanceada', 'Si es severa y sin causa aparente']
            ];
        @endphp

        <div class="alert alert-info mt-4">
            <h5 class="mb-2">🧾 Diagnóstico detallado por síntoma:</h5>

            @foreach ($sintomasSeleccionados as $sintoma)
                @php
                    $clave = strtolower($sintoma);
                    $info = $tablaSintomas[$clave] ?? null;
                @endphp

                <div class="sintoma-box">
                    <h5 class="text-primary">🩹 Síntoma: {{ ucfirst($sintoma) }}</h5>

                    @if ($info)
                        <p>
                            <strong>🦠 Causas comunes:</strong> {{ $info[0] }}<br>
                            <strong>💊 Qué puede tomar o hacer:</strong> {{ $info[1] }}<br>
                            <strong>🚨 Cuándo debe ir urgente:</strong> {{ $info[2] }}
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

   
</div>
@endsection
