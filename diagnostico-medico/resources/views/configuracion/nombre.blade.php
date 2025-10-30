@extends('layouts.app')

@section('content')
<div class="card shadow p-4">
    <h3 class="text-primary">✏️ Editar nombre</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/configuracion/nombre') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nuevo nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('usuario_nombre') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
