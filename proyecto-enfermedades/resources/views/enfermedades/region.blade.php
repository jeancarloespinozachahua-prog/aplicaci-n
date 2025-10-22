@extends('layouts.app')

@section('title', 'Enfermedades en ' . $region)

@section('content')
  <h2 style="text-align:center; margin-bottom: 20px;">📍 Enfermedades frecuentes en {{ $region }}</h2>

  @if($enfermedades->isEmpty())
    <p style="text-align:center; color: #ff4444;">⚠️ No se encontraron enfermedades registradas en esta región.</p>
  @else
    <table style="width:100%; border-collapse: collapse; margin-bottom: 30px;">
      <thead style="background-color: #1b2735; color: #00ffff;">
        <tr>
          <th style="padding: 10px; border-bottom: 2px solid #00ffff;">Nombre</th>
          <th style="padding: 10px; border-bottom: 2px solid #00ffff;">Descripción</th>
          <th style="padding: 10px; border-bottom: 2px solid #00ffff;">Gravedad</th>
          <th style="padding: 10px; border-bottom: 2px solid #00ffff;">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($enfermedades as $enfermedad)
          <tr style="background-color: #222; color: white;">
            <td style="padding: 10px;">{{ $enfermedad->nombre }}</td>
            <td style="padding: 10px;">{{ $enfermedad->descripcion }}</td>
            <td style="padding: 10px;">{{ $enfermedad->gravedad ?? 'No especificada' }}</td>
            <td style="padding: 10px;">
              <a href="{{ route('enfermedades.edit', $enfermedad->id) }}" style="color: #00ffff; margin-right: 10px;">📝 Editar</a>
              <form action="{{ route('enfermedades.destroy', $enfermedad->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('¿Eliminar esta enfermedad?')" style="background:none; border:none; color:#ff4444; cursor:pointer;">🗑️ Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <div style="text-align:center;">
    <a href="{{ route('enfermedades.index') }}" style="color:#00ffff; font-weight:bold;">🔙 Volver al listado</a>
  </div>
@endsection
