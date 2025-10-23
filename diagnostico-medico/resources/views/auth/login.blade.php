@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #e3f2fd, #fce4ec);
    }

    .login-card {
        animation: fadeIn 0.6s ease-in-out;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        padding: 30px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-avatar {
        width: 100px;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        margin-bottom: 15px;
    }

    input:focus {
        box-shadow: 0 0 5px #2196f3;
        border-color: #2196f3;
    }

    .footer-note {
        font-size: 0.9em;
        color: #777;
        margin-top: 20px;
        text-align: center;
    }

    .dark-mode {
        background: #121212 !important;
        color: #f0f0f0;
    }

    .dark-mode .login-card {
        background-color: #1e1e1e;
        color: #f0f0f0;
    }

    .dark-mode input {
        background-color: #2c2c2c;
        color: #fff;
        border-color: #555;
    }

    .dark-mode .btn-primary {
        background-color: #1976d2;
        border-color: #1976d2;
    }

    .register-link {
        margin-top: 15px;
        text-align: center;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5" style="max-width: 400px;">
    

    {{-- Avatar encantador --}}
    <div class="text-center">
        <img src="https://tse4.mm.bing.net/th/id/OIP.i7BqEaCyeS9uP5smpZWTgAHaE8?pid=Api&P=0&h=180"
             alt="Avatar Médico" class="login-avatar">
    </div>

    {{-- Tarjeta de acceso --}}
    <div class="login-card">
        <h2 class="text-center text-primary mb-4">🔐 Login</h2>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.autenticar') }}">
            @csrf

            <div class="mb-3">
                <label for="email">📧 Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password">🔑 Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">🔓 Ingresar al sistema</button>
        </form>

        {{-- Enlace para crear cuenta --}}
        <div class="register-link">
            ¿No tienes cuenta?
            <a href="{{ route('register.formulario') }}">📝 Crear nueva cuenta</a>
        </div>
    </div>

    {{-- Botón de modo oscuro --}}
    <div class="text-center mt-3">
        <button class="btn btn-sm btn-outline-secondary" onclick="document.body.classList.toggle('dark-mode')">🌙 Modo oscuro</button>
    </div>

    {{-- Pie institucional --}}
    <div class="footer-note">
        Sistema desarrollado por <strong>Jean Carlo Espinoza Chahua</strong><br>
        <small>© {{ date('Y') }} Diagnóstico Médico | Todos los derechos reservados</small>
    </div>
</div>

{{-- Animación de carga al enviar --}}
<script>
    document.querySelector('form').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '🔄 Verificando...';
        btn.disabled = true;
    });
</script>
@endsection
