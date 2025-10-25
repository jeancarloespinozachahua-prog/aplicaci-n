@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        {{-- Avatar institucional encantador --}}
        <div class="text-center mb-4">
            <img src="https://tse4.mm.bing.net/th/id/OIP.i7BqEaCyeS9uP5smpZWTgAHaE8?pid=Api&P=0&h=180"
                 alt="Avatar Médico" class="rounded-circle shadow" width="120">
        </div>

        <h3 class="text-center text-primary mb-3">🩺 Diagnóstico Médico</h3>
        <p class="text-center">Selecciona los síntomas del paciente:</p>

        {{-- Información del paciente --}}
        <div class="text-center mb-3">
            <p><strong>Paciente:</strong> {{ $nombre }}</p>
            <p><strong>DNI:</strong> {{ $dni }}</p>
        </div>

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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sintomas[]" value="{{ $sintoma }}" id="sintoma{{ $index }}">
                            <label class="form-check-label" for="sintoma{{ $index }}">{{ $sintoma }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2">🔍 Diagnóstico Tradicional</button>
        </form>

        <form method="POST" action="{{ route('diagnostico.ia') }}" class="d-inline">
            @csrf
            <input type="hidden" name="sintomas" id="sintomasIA">
            <button type="submit" class="btn btn-danger">🤖 Diagnóstico con IA</button>
        </form>
        
    </div>
</div>

<script>
    // Captura los síntomas seleccionados y los pasa al formulario de IA
    document.querySelector('form[action="{{ route('diagnostico.ia') }}"]').addEventListener('submit', function(e) {
        const seleccionados = Array.from(document.querySelectorAll('input[name="sintomas[]"]:checked'))
            .map(el => el.value);
        document.getElementById('sintomasIA').value = seleccionados.join(', ');
    });
</script>
@endsection
