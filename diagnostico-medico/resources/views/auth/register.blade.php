@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        font-family: 'Segoe UI', sans-serif;
        overflow-x: hidden;
    }

    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }

    .register-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
        padding: 40px;
        width: 100%;
        max-width: 500px;
        animation: fadeInUp 0.8s ease;
        color: #333;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .register-card h2 {
        font-weight: bold;
    }

    label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    input {
        background-color: rgba(255,255,255,0.9);
        border: 1px solid #ccc;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        width: 100%;
        transition: box-shadow 0.3s ease;
    }

    input:focus {
        box-shadow: 0 0 8px #2196f3;
        border-color: #2196f3;
    }

    .btn-register {
        background-color: #4caf50;
        border: none;
        color: white;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        font-weight: bold;
        font-size: 1.1em;
        transition: background-color 0.3s ease;
    }

    .btn-register:hover {
        background-color: #43a047;
    }

    .dark-mode {
        background: #121212 !important;
        color: #f0f0f0;
    }

    .dark-mode .register-card {
        background-color: rgba(30,30,30,0.85);
        color: #f0f0f0;
    }

    .dark-mode input {
        background-color: #2c2c2c;
        color: #fff;
        border-color: #555;
    }

    .dark-mode .btn-register {
        background-color: #43a047;
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

    .input-group {
        display: flex;
        align-items: center;
    }

    .input-group input {
        flex: 1;
    }

    .input-group button {
        margin-left: 8px;
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #eee;
        cursor: pointer;
    }

    .dark-mode .input-group button {
        background-color: #444;
        color: #fff;
        border-color: #666;
    }
</style>

<div class="register-container">
    <div class="particles"></div>

    <div class="register-card">
        <h2 class="text-center text-primary mb-4">📝 Crear nueva cuenta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.guardar') }}">
            @csrf
            <div class="mb-3">
                <label for="name">Nombre completo</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" required>
            </div>

            <div class="mb-3">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" required>
                    <button type="button" onclick="togglePassword()">👁️</button>
                </div>
            </div>

            <button type="submit" class="btn-register">✅ Registrar cuenta</button>
        </form>

        <div class="text-center mt-3">
            <button class="btn btn-sm btn-outline-secondary" onclick="document.body.classList.toggle('dark-mode')">
                🌙 Activar modo oscuro
            </button>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
