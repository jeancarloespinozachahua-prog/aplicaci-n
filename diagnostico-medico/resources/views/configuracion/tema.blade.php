@extends('layouts.app')

@section('content')
<style>
    /* Tema claro */
    .tema-claro {
        background-color: #f8f9fa;
        color: #212529;
    }

    /* Tema oscuro */
    .tema-oscuro {
        background-color: #212529;
        color: #f8f9fa;
    }

    /* Tema mágico */
    .tema-magico {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        color: #4a148c;
    }

    .tema-card {
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease-in-out;
        background-color: rgba(255, 255, 255, 0.8);
    }

    .tema-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .form-select {
        border-radius: 8px;
        border: 1px solid #b0bec5;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-primary {
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 500;
        background: linear-gradient(to right, #42a5f5, #1e88e5);
        border: none;
        color: white;
        transition: background 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #1e88e5, #42a5f5);
    }

    .alert-success {
        border-left: 4px solid #66bb6a;
        background: linear-gradient(135deg, #d0f0ff, #c8e6c9);
        color: #1b5e20;
        border-radius: 8px;
        padding: 16px;
        margin-top: 20px;
    }
</style>

<div class="tema-card tema-{{ session('usuario_tema', 'claro') }}">
    <h3 class="text-primary">🎨 Tema visual</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/configuracion/tema') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tema" class="form-label">Selecciona tu estilo preferido</label>
            <select name="tema" id="tema" class="form-select" required>
                <option value="claro" {{ session('usuario_tema') === 'claro' ? 'selected' : '' }}>Claro</option>
                <option value="oscuro" {{ session('usuario_tema') === 'oscuro' ? 'selected' : '' }}>Oscuro</option>
                <option value="magico" {{ session('usuario_tema') === 'magico' ? 'selected' : '' }}>Mágico</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-palette-fill me-1"></i> Guardar tema
        </button>
    </form>
</div>
@endsection
