@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2 class="text-success">✅ Bienvenido, {{ session('usuario_nombre') }}</h2>
    <p>DNI registrado: <strong>{{ session('usuario_dni') }}</strong></p>
    <p>Accede al diagnóstico médico desde el menú.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger mt-3">Cerrar sesión</button>
    </form>
</div>
@endsection
