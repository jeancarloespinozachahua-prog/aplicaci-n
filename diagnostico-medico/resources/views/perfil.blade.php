@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">👤 Perfil del Usuario</h3>

    <!-- Foto de perfil -->
    <div class="text-center mb-4">
        @if(session('usuario_foto'))
            <img src="{{ asset('storage/' . session('usuario_foto')) }}" class="rounded-circle shadow" width="120" height="120" alt="Foto de perfil">
        @else
            <img src="{{ asset('images/default-avatar.png') }}" class="rounded-circle shadow" width="120" height="120" alt="Foto por defecto">
        @endif
    </div>

    <!-- Formulario de edición -->
    <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('usuario_nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" value="{{ session('usuario_dni') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto de perfil</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>Guardar cambios
        </button>
    </form>
</div>
@endsection
