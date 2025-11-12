@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        font-family: 'Segoe UI', sans-serif;
        overflow-x: hidden;
    }

    .soporte-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 60px 20px;
        position: relative;
        z-index: 1;
    }

    .soporte-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        padding: 40px;
        width: 100%;
        max-width: 800px;
        animation: fadeInUp 0.8s ease;
        color: #333;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    input, textarea {
        background-color: rgba(255,255,255,0.9);
        border: 1px solid #ccc;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        transition: box-shadow 0.3s ease;
    }

    input:focus, textarea:focus {
        box-shadow: 0 0 8px #2196f3;
        border-color: #2196f3;
    }

    .btn-primary {
        font-weight: bold;
        font-size: 1.05em;
        padding: 10px;
        border-radius: 8px;
    }

    .solicitud-box {
        background-color: #f9f9f9;
        border-left: 4px solid #2196f3;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
    }

    .solicitud-box strong {
        font-size: 1.1em;
    }

    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png');
        opacity: 0.1;
        z-index: 0;
    }
</style>

<div class="soporte-container">
    <div class="particles"></div>

    <div class="soporte-card">
        <h3 class="mb-4">🛠️ Soporte técnico</h3>

        @if(session()->has('usuario_nombre'))
            <p class="text-muted">Sesión activa como: <strong>{{ session('usuario_nombre') }}</strong> (DNI: {{ session('usuario_dni') }})</p>
        @else
            <p class="text-danger">⚠️ Sesión no detectada. No se podrá enviar soporte.</p>
        @endif

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <span class="me-2">✅</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="me-2">⚠️</span>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <form method="POST" action="{{ route('soporte.enviar') }}" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="asunto">Asunto</label>
                <input type="text" name="asunto" id="asunto" required>
            </div>

            <div class="mb-3">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="archivo">Archivo adjunto (opcional)</label>
                <input type="file" name="archivo" id="archivo">
            </div>

            <button type="submit" class="btn btn-primary">📨 Enviar solicitud</button>
        </form>

        <hr class="my-4">

        <h5>📋 Tus solicitudes anteriores</h5>
        @forelse($solicitudes as $solicitud)
            <div class="solicitud-box">
                <strong>{{ $solicitud->asunto }}</strong>
                <span class="text-muted">({{ $solicitud->estado }})</span><br>
                <small>{{ $solicitud->created_at->format('d/m/Y H:i') }}</small>
                <p class="mt-2">{{ $solicitud->mensaje }}</p>
                @if($solicitud->archivo)
                    <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank">📎 Ver archivo</a>
                @endif
            </div>
        @empty
            <p class="text-muted">No has enviado ninguna solicitud aún.</p>
        @endforelse
    </div>
</div>
@endsection
