@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card datos-personales-card shadow p-4">
        <h3 class="text-primary text-center mb-4">📋 Datos personales</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <form action="{{ url('/configuracion/datos') }}" method="POST" class="mx-auto" style="max-width: 500px;">
            @csrf

            <div class="mb-3">
                <label for="edad" class="form-label fw-bold">🎂 Edad</label>
                <input type="number" name="edad" id="edad" class="form-control" value="{{ session('usuario_edad') }}" required>
            </div>

            <div class="mb-3">
                <label for="peso" class="form-label fw-bold">⚖️ Peso (kg)</label>
                <input type="number" step="0.1" name="peso" id="peso" class="form-control" value="{{ session('usuario_peso') }}" required>
            </div>

            <div class="mb-3">
                <label for="altura" class="form-label fw-bold">📏 Altura (cm)</label>
                <input type="number" step="0.1" name="altura" id="altura" class="form-control" value="{{ session('usuario_altura') }}" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    💾 Guardar datos
                </button>
            </div>
        </form>
    </div>

    {{-- Historial clínico subido --}}
    @if(isset($historiales) && count($historiales) > 0)
        <div class="card shadow mt-5 historial-card p-4">
            <h4 class="text-success mb-3">📄 Historiales clínicos subidos</h4>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Archivo</th>
                        <th>Fecha de subida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historiales as $historial)
                        <tr>
                            <td>{{ basename($historial->archivo) }}</td>
                            <td>{{ $historial->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $historial->archivo) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye-fill me-1"></i> Ver
                                </a>
                                <form action="{{ route('historial.eliminar', $historial->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar este historial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash-fill me-1"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
.datos-personales-card {
    background: linear-gradient(to right, #e3f2fd, #fce4ec);
    border-radius: 16px;
    animation: fadeIn 0.5s ease-in-out;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: background 0.3s ease;
}

.historial-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.datos-personales-card .form-control {
    border-radius: 8px;
    border: 2px solid #007bff;
    transition: border-color 0.3s ease;
}

.datos-personales-card .form-control:focus {
    border-color: #0056b3;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

.datos-personales-card .btn-primary {
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Modo oscuro */
body.dark-mode .datos-personales-card,
body.dark-mode .historial-card {
    background: linear-gradient(to right, #1e1e1e, #2c2c2c);
    color: #f0f0f0;
}

body.dark-mode .form-control {
    background-color: #2c2c2c;
    color: #fff;
    border-color: #80d8ff;
}

body.dark-mode .form-control:focus {
    border-color: #80d8ff;
    box-shadow: 0 0 5px rgba(128,216,255,0.3);
}

body.dark-mode .btn-outline-primary {
    border-color: #80d8ff;
    color: #80d8ff;
}

body.dark-mode .btn-outline-danger {
    border-color: #ef9a9a;
    color: #ef9a9a;
}
</style>
@endsection
