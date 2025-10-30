@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1>Bienvenido al Sistema de Diagnóstico Médico</h1>
    <p>Este es el punto de entrada principal.</p>
    <a href="{{ route('login.formulario') }}" class="btn btn-primary mt-3">🔐 Iniciar sesión con Google</a>
</div>
@endsection
