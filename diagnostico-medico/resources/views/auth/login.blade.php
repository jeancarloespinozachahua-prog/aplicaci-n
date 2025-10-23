@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center text-primary mb-4">🔐 Acceso al Diagnóstico</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.autenticar') }}">
        @csrf
        <div class="mb-3">
            <label for="nombre">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
</div>
@endsection
