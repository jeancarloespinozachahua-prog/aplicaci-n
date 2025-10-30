@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">📋 Datos personales</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/configuracion/datos') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" name="edad" id="edad" class="form-control" value="{{ session('usuario_edad') }}" required>
        </div>

        <div class="mb-3">
            <label for="peso" class="form-label">Peso (kg)</label>
            <input type="number" step="0.1" name="peso" id="peso" class="form-control" value="{{ session('usuario_peso') }}" required>
        </div>

        <div class="mb-3">
            <label for="altura" class="form-label">Altura (cm)</label>
            <input type="number" step="0.1" name="altura" id="altura" class="form-control" value="{{ session('usuario_altura') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar datos
        </button>
    </form>
</div>

{{-- Historial clínico subido --}}
@if(isset($historiales) && count($historiales) > 0)
    <div class="card shadow mt-4 p-4">
        <h4 class="text-success">📄 Historiales clínicos subidos</h4>

        <table class="table table-bordered table-hover mt-3">
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
@endsection
