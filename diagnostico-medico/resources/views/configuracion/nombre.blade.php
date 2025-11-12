@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card editar-nombre-card shadow p-4">
        <h3 class="text-primary text-center mb-4">✏️ Editar nombre</h3>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <form action="{{ url('/configuracion/nombre') }}" method="POST" class="mx-auto" style="max-width: 500px;">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">🧑‍💼 Nuevo nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('usuario_nombre') }}" required>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    💾 Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.editar-nombre-card {
    background: linear-gradient(to right, #e3f2fd, #fce4ec);
    border-radius: 16px;
    animation: fadeIn 0.5s ease-in-out;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: background 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.editar-nombre-card .form-control {
    border-radius: 8px;
    border: 2px solid #007bff;
    transition: border-color 0.3s ease;
}

.editar-nombre-card .form-control:focus {
    border-color: #0056b3;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

.editar-nombre-card .btn-primary {
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Modo oscuro */
body.dark-mode .editar-nombre-card {
    background: linear-gradient(to right, #1e1e1e, #2c2c2c);
    color: #f0f0f0;
}

body.dark-mode .editar-nombre-card .form-control {
    background-color: #2c2c2c;
    color: #fff;
    border-color: #80d8ff;
}

body.dark-mode .editar-nombre-card .form-control:focus {
    border-color: #80d8ff;
    box-shadow: 0 0 5px rgba(128,216,255,0.3);
}

body.dark-mode .editar-nombre-card .btn-primary {
    background-color: #2196f3;
    border-color: #2196f3;
}
</style>
@endsection
