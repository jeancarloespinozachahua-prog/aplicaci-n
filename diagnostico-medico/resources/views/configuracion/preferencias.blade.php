@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">⚙️ Preferencias de diagnóstico</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/configuracion/preferencias') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel de detalle en los resultados</label>
            <select name="nivel" id="nivel" class="form-select" required>
                <option value="basico" {{ session('usuario_nivel_diagnostico') === 'basico' ? 'selected' : '' }}>Básico</option>
                <option value="intermedio" {{ session('usuario_nivel_diagnostico') === 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                <option value="experto" {{ session('usuario_nivel_diagnostico') === 'experto' ? 'selected' : '' }}>Experto</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar preferencias</button>
    </form>
</div>
@endsection
