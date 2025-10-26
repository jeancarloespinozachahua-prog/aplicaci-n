@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">👤 Perfil del Usuario</h3>
    <p>Nombre: {{ session('usuario_nombre') }}</p>
    <p>DNI: {{ session('usuario_dni') }}</p>
    <p>Desde aquí puedes revisar tu información y actualizarla si es necesario.</p>
</div>
@endsection
