@extends('layouts.app')

@section('content')
<div class="card shadow p-4 text-center">
    <h3 class="text-danger">🚪 Sesión cerrada</h3>
    <p>Gracias por usar GlucoSense. Tu sesión ha sido finalizada correctamente.</p>
    <a href="{{ route('login.formulario') }}" class="btn btn-outline-primary mt-3">🔐 Volver a iniciar sesión</a>
</div>
@endsection
