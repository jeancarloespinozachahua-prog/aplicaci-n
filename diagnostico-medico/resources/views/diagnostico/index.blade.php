@extends('layouts.app')

@section('content')
<div class="container mt-5">

    {{-- Avatar institucional encantador --}}
    <div class="text-center mb-4">
        <img src="https://tse4.mm.bing.net/th/id/OIP.i7BqEaCyeS9uP5smpZWTgAHaE8?pid=Api&P=0&h=180" alt="Avatar Médico" class="rounded-circle shadow" width="120">
    </div>

    <h2 class="text-center text-primary">🩺 Diagnóstico Médico</h2>
    <p class="text-center">Selecciona los síntomas del paciente:</p>

    {{-- Información del paciente --}}
    @if(session('usuario_nombre') && session('usuario_dni'))
        <div class="text-center mb-3">
            <p><strong>Paciente:</strong> {{ session('usuario_nombre') }}</p>
            <p><strong>DNI:</strong> {{ session('usuario_dni') }}</p>
        </div>
    @endif

    <form method="POST" action="" class="mt-4">
        @csrf
        <div class="row">
            @php
                $sintomas = [
                    'fiebre', 'tos', 'dolor de cabeza', 'dolor muscular', 'náuseas',
                    'vómitos', 'diarrea', 'dolor abdominal', 'fatiga', 'mareos',
                    'dolor de garganta', 'congestión nasal', 'dificultad para respirar', 'pérdida del olfato',
                    'pérdida del gusto', 'erupciones en la piel', 'ojos rojos', 'escalofríos',
                    'dolor en el pecho', 'palpitaciones'
                ];
            @endphp

            @foreach($sintomas as $index => $sintoma)
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sintomas[]" value="{{ $sintoma }}" id="sintoma{{ $index }}">
                        <label class="form-check-label" for="sintoma{{ $index }}">
                            {{ ucfirst($sintoma) }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <button formaction="/diagnostico" class="btn btn-primary">Diagnóstico Tradicional</button>
            <button formaction="/diagnostico-ia" class="btn btn-warning">Diagnóstico con IA</button>
        </div>
    </form>
</div>
@endsection
