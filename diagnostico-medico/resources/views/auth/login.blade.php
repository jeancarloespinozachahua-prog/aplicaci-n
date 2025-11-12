@extends('layouts.auth')

@section('content')
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background: url('https://images.alphacoders.com/546/thumb-1920-546091.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #f0f0f0;
    overflow: hidden;
  }

  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    position: relative;
    z-index: 1;
    padding: 20px;
  }

  .login-card {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    padding: 50px 30px;
    width: 100%;
    max-width: 420px;
    animation: fadeInUp 0.8s ease;
    position: relative;
    z-index: 2;
    border: 1px solid rgba(255,255,255,0.2);
  }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .login-avatar {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 0 16px rgba(0,0,0,0.4);
    margin-bottom: -50px;
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #fff;
    z-index: 3;
  }

  .form-control {
    background-color: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    padding: 10px 12px;
    border-radius: 8px;
    width: 90%;
    color: #fff;
    font-size: 0.95rem;
    margin-bottom: 16px;
    transition: box-shadow 0.3s ease;
  }

  .form-control::placeholder {
    color: #ccc;
  }

  .form-control:focus {
    box-shadow: 0 0 8px #00bcd4;
    border-color: #00bcd4;
    outline: none;
  }

  .btn-success {
    background: linear-gradient(to right, #00bcd4, #0097a7);
    border: none;
    font-weight: bold;
    font-size: 1.05em;
    padding: 12px;
    border-radius: 10px;
    color: #fff;
    width: 90%;
    transition: transform 0.2s ease;
  }

  .btn-success:hover {
    transform: scale(1.03);
    box-shadow: 0 0 10px rgba(0,188,212,0.4);
  }

  .footer-note {
    font-size: 0.9em;
    color: #ccc;
    margin-top: 25px;
    text-align: center;
  }

  .alert {
    background-color: rgba(255, 0, 0, 0.1);
    border: 1px solid rgba(255, 0, 0, 0.3);
    color: #ffdddd;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 20px;
  }
</style>

<div class="login-container">
  <div class="login-card position-relative">
    {{-- Avatar encantador --}}
    <img src="https://tse4.mm.bing.net/th/id/OIP.i7BqEaCyeS9uP5smpZWTgAHaE8?pid=Api&P=0&h=180" alt="Avatar Médico" class="login-avatar">
    <h2 class="text-center text-info mb-4 mt-5">🔐 Acceso al sistema</h2>

    {{-- Mensaje de error de sesión --}}
    @if(session('error'))
      <div class="alert text-center">
        {{ session('error') }}
      </div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
      <div class="alert">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Formulario de acceso libre --}}
    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <input type="text" name="nombre" placeholder="Nombre completo" required class="form-control">
      <input type="text" name="dni" placeholder="DNI" required class="form-control">
      <button type="submit" class="btn btn-success">🔓 Ingresar</button>
    </form>

    <div class="footer-note">
      <small>© {{ date('Y') }} Diagnóstico Médico | Todos los derechos reservados</small>
    </div>
  </div>
</div>
@endsection
