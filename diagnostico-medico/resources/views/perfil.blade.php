@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="profile-card card shadow p-4">
        <h3 class="text-primary text-center mb-4">👤 Perfil del Usuario</h3>

        <!-- Foto de perfil -->
        <div class="text-center mb-4">
            @if(session('usuario_foto'))
                <img src="{{ asset('storage/' . session('usuario_foto')) }}"
                     class="rounded-circle shadow profile-avatar"
                     alt="Foto de perfil">
            @else
                <img src="{{ asset('images/default-avatar.png') }}"
                     class="rounded-circle shadow profile-avatar"
                     alt="Foto por defecto">
            @endif
        </div>

        <!-- Formulario de edición -->
        <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">📝 Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('usuario_nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="dni" class="form-label fw-bold">🆔 DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" value="{{ session('usuario_dni') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label fw-bold">📷 Foto de perfil</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    💾 Guardar cambios
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.profile-card {
    background: linear-gradient(to right, #fce4ec, #e3f2fd);
    border-radius: 16px;
    animation: fadeIn 0.6s ease-in-out;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: background 0.3s ease;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid #7df316ff;
    box-shadow: 0 0 12px rgba(0,0,0,0.2);
    transition: transform 0.3s ease;
}

.profile-avatar:hover {
    transform: scale(1.05);
}

.profile-card .form-label {
    color: #333;
}

.profile-card .btn-primary {
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Modo oscuro */
body.dark-mode .profile-card {
    background: linear-gradient(to right, #1e1e1e, #2c2c2c);
    color: #f72525ff;
}

body.dark-mode .profile-card .form-control {
    background-color: #2c2c2c;
    color: #16ef28ff;
    border-color: #555;
}

body.dark-mode .profile-card .btn-primary {
    background-color: #258bdeff;
    border-color: #2196f3;
    color: #f42727ff;
}
</style>
@endsection
