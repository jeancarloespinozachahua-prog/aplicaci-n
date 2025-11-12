@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="diagnostico-card card shadow p-4">
        {{-- Avatar institucional encantador --}}
        <div class="text-center mb-4">
            <img src="https://tse4.mm.bing.net/th/id/OIP.i7BqEaCyeS9uP5smpZWTgAHaE8?pid=Api&P=0&h=180"
                 alt="Avatar Médico" class="rounded-circle shadow diagnostico-avatar">
        </div>

        <h3 class="text-center text-gradient mb-3">🩺 Diagnóstico Médico</h3>
        <p class="text-center text-muted">Selecciona los síntomas del paciente:</p>

        {{-- Información del paciente --}}
        <div class="text-center mb-3">
            <p><strong>Paciente:</strong> {{ $nombre }}</p>
            <p><strong>DNI:</strong> {{ $dni }}</p>
        </div>

        {{-- Checkboxes de síntomas --}}
        <form method="POST" action="{{ route('diagnostico.tradicional') }}">
            @csrf
            <div class="row">
                @foreach([
                    'Fiebre', 'Dolor muscular', 'Diarrea', 'Mareos', 'Dificultad para respirar',
                    'Erupciones en la piel', 'Dolor en el pecho', 'Tos', 'Náuseas', 'Dolor abdominal',
                    'Dolor de garganta', 'Pérdida del olfato', 'Ojos rojos', 'Palpitaciones',
                    'Dolor de cabeza', 'Fatiga', 'Congestión nasal', 'Pérdida del gusto'
                ] as $index => $sintoma)
                    <div class="col-md-6 mb-2">
                        <div class="form-check diagnostico-check">
                            <input class="form-check-input" type="checkbox" name="sintomas[]" value="{{ $sintoma }}" id="sintoma{{ $index }}">
                            <label class="form-check-label" for="sintoma{{ $index }}">{{ $sintoma }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                <button type="submit" class="btn btn-gradient-primary px-4">
                    🔍 Diagnóstico con IA
                </button>

                <form method="POST" action="{{ route('diagnostico.urgencia') }}" id="formUrgencia">
                    @csrf
                    <input type="hidden" name="sintomas[]" id="sintomasUrgencia">
                    <button type="submit" class="btn btn-gradient-warning px-4">
                        🚨 Verificar Urgencia
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>

<style>
.diagnostico-card {
    background: linear-gradient(to right, #e0f7fa, #f0f4ff);
    border-radius: 16px;
    animation: fadeIn 0.6s ease-in-out;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    transition: background 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.text-gradient {
    background: linear-gradient(to right, #0056b3, #007bff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}

.diagnostico-avatar {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.diagnostico-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px rgba(0,0,0,0.3);
}

.diagnostico-check .form-check-input {
    border-radius: 6px;
    border: 2px solid #007bff;
    transition: all 0.2s ease;
}

.diagnostico-check .form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.diagnostico-check .form-check-label {
    font-weight: 500;
    color: #333;
}

.btn-gradient-primary {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    transition: transform 0.2s ease;
}

.btn-gradient-primary:hover {
    transform: scale(1.05);
}

.btn-gradient-warning {
    background: linear-gradient(to right, #f9d423, #ff4e50);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    transition: transform 0.2s ease;
}

.btn-gradient-warning:hover {
    transform: scale(1.05);
}
</style>

<script>
document.getElementById('formUrgencia').addEventListener('submit', function(e) {
    const seleccionados = Array.from(document.querySelectorAll('input[name="sintomas[]"]:checked'));
    seleccionados.forEach(el => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'sintomas[]';
        input.value = el.value;
        this.appendChild(input);
    });
});
</script>
@endsection
