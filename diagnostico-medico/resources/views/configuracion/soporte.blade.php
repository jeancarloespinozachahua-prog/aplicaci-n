@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="mb-4">🛠️ Soporte técnico</h3>

    {{-- Estado de sesión --}}
    @if(session()->has('usuario_nombre'))
        <p class="text-muted">Sesión activa como: {{ session('usuario_nombre') }} (DNI: {{ session('usuario_dni') }})</p>
    @else
        <p class="text-danger">⚠️ Sesión no detectada. No se podrá enviar soporte.</p>
    @endif

    {{-- Mensajes de sesión --}}
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

    {{-- Formulario de soporte --}}
    <form method="POST" action="{{ route('soporte.enviar') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto</label>
            <input type="text" name="asunto" id="asunto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" id="mensaje" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="archivo" class="form-label">Archivo adjunto (opcional)</label>
            <input type="file" name="archivo" id="archivo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">📨 Enviar solicitud</button>
    </form>

    <hr class="my-4">

    {{-- Historial de solicitudes --}}
    <h5>📋 Tus solicitudes anteriores</h5>
    @forelse($solicitudes as $solicitud)
        <div class="border rounded p-3 mb-2">
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
@endsection
