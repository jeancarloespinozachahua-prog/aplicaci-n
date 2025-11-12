@extends('layouts.app')

@section('content')
<div class="cerrar-container container mt-5">
    <div class="cerrar-card card shadow text-center p-5">
        <div class="cerrar-icon mb-4">
            <span class="emoji">🚪</span>
        </div>

        <h3 class="text-gradient mb-3">Sesión cerrada correctamente</h3>
        <p class="text-muted">Gracias por usar <strong>GlucoSense</strong>. Tu sesión ha sido finalizada con éxito.</p>

        @isset($nombre)
            <p class="mt-3">👤 Usuario: <strong>{{ $nombre }}</strong></p>
        @endisset

        @isset($dni)
            <p>DNI: <strong>{{ $dni }}</strong></p>
        @endisset

        <a href="{{ route('login') }}" class="btn btn-gradient-primary mt-4 px-4 py-2">
            🔐 Volver a iniciar sesión
        </a>
    </div>
</div>

<style>
body {
    background: linear-gradient(to bottom right, #e0f7fa, #f0f4ff);
    font-family: 'Segoe UI', sans-serif;
}

.cerrar-card {
    border-radius: 16px;
    background: linear-gradient(to right, #ffffff, #f9fcff);
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    animation: fadeIn 0.6s ease-in-out;
}

.cerrar-icon .emoji {
    font-size: 3rem;
    animation: bounce 1.2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

.text-gradient {
    background: linear-gradient(to right, #0056b3, #007bff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}

.btn-gradient-primary {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-gradient-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 0 12px rgba(0,0,0,0.2);
}
</style>
@endsection
