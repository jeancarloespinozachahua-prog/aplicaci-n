@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        font-family: 'Segoe UI', sans-serif;
        overflow-x: hidden;
    }

    .preferencias-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 60px 20px;
        position: relative;
        z-index: 1;
    }

    .preferencias-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        padding: 40px;
        width: 100%;
        max-width: 600px;
        animation: fadeInUp 0.8s ease;
        color: #333;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    label {
        font-weight: 500;
        margin-bottom: 8px;
    }

    select {
        background-color: rgba(255,255,255,0.9);
        border: 1px solid #ccc;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        transition: box-shadow 0.3s ease;
        font-size: 1em;
    }

    select:focus {
        box-shadow: 0 0 8px #2196f3;
        border-color: #2196f3;
    }

    .btn-primary {
        font-weight: bold;
        font-size: 1.05em;
        padding: 10px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .alert-success {
        font-size: 0.95em;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
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

<div class="preferencias-container">
    <div class="particles"></div>

    <div class="preferencias-card">
        <h3 class="text-primary mb-4">⚙️ Preferencias de diagnóstico</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url('/configuracion/preferencias') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nivel">Nivel de detalle en los resultados</label>
                <select name="nivel" id="nivel" required>
                    <option value="basico" {{ session('usuario_nivel_diagnostico') === 'basico' ? 'selected' : '' }}>🧪 Básico</option>
                    <option value="intermedio" {{ session('usuario_nivel_diagnostico') === 'intermedio' ? 'selected' : '' }}>🔬 Intermedio</option>
                    <option value="experto" {{ session('usuario_nivel_diagnostico') === 'experto' ? 'selected' : '' }}>🧠 Experto</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">✅ Guardar preferencias</button>
        </form>
    </div>
</div>
@endsection
