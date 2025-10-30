@extends('layouts.app')

@section('content')
<div class="card shadow p-4 text-center">
    <h3 class="text-danger">🚪 Sesión cerrada</h3>
    <p>Gracias por usar GlucoSense. Tu sesión ha sido finalizada correctamente.</p>

    @isset($nombre)
        <p class="mt-3">👤 Usuario: <strong>{{ $nombre }}</strong></p>
    @endisset

    @isset($dni)
        <p>DNI: <strong>{{ $dni }}</strong></p>
    @endisset

    <a href="{{ route('login.formulario') }}" class="btn btn-outline-primary mt-4">🔐 Volver a iniciar sesión</a>
</div>
@endsection
