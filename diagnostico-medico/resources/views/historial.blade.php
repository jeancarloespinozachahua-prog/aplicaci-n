@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f5f5f5, #e0f7fa);
        font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
        background-color: #1976d2;
        padding: 15px 30px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar a {
        color: white;
        margin-right: 20px;
        text-decoration: none;
        font-weight: bold;
    }

    .navbar .user {
        font-weight: bold;
    }

    .tabs {
        background-color: #eeeeee;
        padding: 10px 30px;
        display: flex;
        gap: 20px;
        border-bottom: 2px solid #ccc;
    }

    .tabs a {
        text-decoration: none;
        font-weight: bold;
        color: #333;
    }

    .tabs a.active {
        color: #1976d2;
        border-bottom: 2px solid #1976d2;
    }

    .content {
        padding: 40px;
        text-align: center;
    }

    .welcome-box {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        font-size: 1.2em;
        color: #333;
    }
</style>

<div class="navbar">
    <div>
        <a href="{{ route('dashboard') }}">Diagnóstico Médico</a>
    </div>
    <div class="user">
        👤 {{ session('usuario_nombre') ?? 'Usuario' }}
    </div>
</div>

<div class="tabs">
    <a href="#" class="active">Panel</a>
    <a href="#">Estudiantes</a>
</div>

<div class="content">
    <div class="welcome-box">
        ¡Has iniciado sesión correctamente, <strong>{{ session('usuario_nombre') }}</strong>! 🎉
    </div>
</div>
@endsection
