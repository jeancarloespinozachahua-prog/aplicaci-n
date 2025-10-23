@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="card p-4 shadow-sm">
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
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">✅ Registrar cuenta</button>
        </form>
    </div>
</div>
@endsection
