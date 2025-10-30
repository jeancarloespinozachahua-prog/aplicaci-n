@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">🛠️ Soporte Técnico</h3>
    <p>¿Tienes problemas con el sistema? Aquí puedes enviar tu consulta o revisar tus solicitudes anteriores.</p>

    {{-- Formulario de contacto --}}
    <form action="{{ route('soporte.enviar') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto</label>
            <input type="text" name="asunto" id="asunto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="4" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="archivo" class="form-label">Adjuntar archivo (opcional)</label>
            <input type="file" name="archivo" id="archivo" class="form-control" accept=".jpg,.png,.pdf,.docx">
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-envelope-fill me-1"></i> Enviar mensaje
        </button>
    </form>

    {{-- Historial de solicitudes --}}
    @if(isset($solicitudes) && count($solicitudes) > 0)
        <div class="mt-5">
            <h5 class="text-secondary">📂 Tus solicitudes anteriores</h5>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>Asunto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $s)
                        <tr>
                            <td>{{ $s->asunto }}</td>
                            <td>{{ $s->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($s->estado) }}</td>
                            <td>
                                @if($s->archivo)
                                    <a href="{{ asset('storage/' . $s->archivo) }}" target="_blank" class="btn btn-outline-primary btn-sm">Ver archivo</a>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Preguntas frecuentes --}}
    <div class="mt-5">
        <h5 class="text-primary">❓ Preguntas frecuentes</h5>
        <ul>
            <li><strong>¿Cómo subo mi historial clínico?</strong> Ve a la sección "Historial" y usa el botón "Subir archivo".</li>
            <li><strong>¿Cómo cambio el idioma?</strong> En "Configuración", selecciona tu idioma preferido.</li>
            <li><strong>¿Cómo contacto al administrador?</strong> Usa el formulario de soporte técnico.</li>
        </ul>
    </div>
</div>
@endsection
