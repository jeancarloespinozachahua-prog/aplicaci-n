<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Lista de Enfermedades</title>
  <style>
    /* Fondo galáctico */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
      z-index: -3;
    }

    /* Rayos animados */
    .rayo {
      position: fixed;
      top: 0;
      width: 2px;
      height: 100%;
      background: white;
      opacity: 0;
      z-index: -1;
      pointer-events: none;
      animation: rayoFlash 8s infinite;
    }

    .rayo:nth-child(1) { left: 30%; animation-delay: 0s; }
    .rayo:nth-child(2) { left: 60%; animation-delay: 2.5s; }
    .rayo:nth-child(3) { left: 45%; animation-delay: 5s; }

    @keyframes rayoFlash {
      0%, 97%, 100% { opacity: 0; transform: scaleX(1) rotate(0deg); }
      98% { opacity: 0.9; transform: scaleX(1.2) rotate(2deg); }
      99% { opacity: 0.3; transform: scaleX(0.9) rotate(-1deg); }
    }

    /* Texto degradado animado */
    .texto-degradado {
      background: linear-gradient(270deg, #8cff00, #ff4d00, #0400ff, #ff00b3);
      background-size: 800% 800%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: animarColor 10s ease infinite;
    }

    @keyframes animarColor {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Estilos generales */
    body {
      margin: 0;
      padding: 20px;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    h1 {
      text-align: center;
      font-size: 2.5em;
      margin-bottom: 30px;
      text-shadow: 2px 2px 6px #ff0000;
    }

    ul {
      padding-left: 0;
      list-style: none;
      max-width: 700px;
      margin: 0 auto;
    }

    li {
      background: rgba(255, 0, 0, 0.8);
      margin-bottom: 12px;
      padding: 15px;
      border-left: 6px solid #fff700;
      box-shadow: 0 4px 8px rgba(0, 255, 0, 0.4);
      border-radius: 8px;
      transition: transform 0.3s ease;
    }

    li:hover {
      transform: scale(1.02);
    }

    .acciones {
      margin-top: 40px;
      text-align: center;
    }

    .acciones a {
      display: inline-block;
      margin: 8px;
      padding: 10px 20px;
      border-radius: 30px;
      background: linear-gradient(135deg, #ff0080, #ff6600);
      color: white;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
      transition: transform 0.3s ease;
    }

    .acciones a:hover {
      transform: scale(1.05);
      filter: brightness(1.2);
    }

    p {
      color: #00ff00;
      font-weight: bold;
      text-align: center;
      text-shadow: 1px 1px 2px #000;
    }

    .busqueda-container {
      text-align: center;
      margin-top: 50px;
    }

    .busqueda-container input {
      padding: 12px 20px;
      font-size: 1.1em;
      border-radius: 30px;
      border: none;
      background: linear-gradient(135deg, #220033, #3f3fff);
      color: white;
      box-shadow: 0 0 12px rgba(0, 255, 255, 0.4);
      outline: none;
      width: 300px;
      text-align: center;
    }

    .busqueda-container button {
      margin-left: 10px;
      padding: 12px 20px;
      font-size: 1.1em;
      border-radius: 30px;
      border: none;
      background: linear-gradient(135deg, #1d1a40, #00ffff);
      color: white;
      box-shadow: 0 0 12px rgba(0, 255, 255, 0.4);
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .busqueda-container button:hover {
      transform: scale(1.05);
      filter: brightness(1.3);
    }
  </style>
</head>
<body>
  <!-- Rayos -->
  <div class="rayo"></div>
  <div class="rayo"></div>
  <div class="rayo"></div>

  <h1 class="texto-degradado">🌟 Enfermedades Registradas</h1>

  @if(session('success'))
    <p>{{ session('success') }}</p>
  @endif

  <ul>
    @foreach ($enfermedades as $enfermedad)
      <li>
        <strong>🩺 {{ $enfermedad->nombre }}</strong><br>
        {{ $enfermedad->descripcion }}
      </li>
    @endforeach
  </ul>

  <div class="acciones">
    <a href="{{ route('enfermedades.create') }}">Dolor de diente</a>
    <a href="{{ route('enfermedades.create') }}">Cáncer al corazón</a>
    <a href="{{ route('enfermedades.create') }}">Tos y gripe</a>
    <a href="{{ route('enfermedades.create') }}">Derrame cerebral</a>
    <a href="{{ route('enfermedades.create') }}">Cáncer al hígado</a>
    <a href="{{ route('enfermedades.create') }}">Dolor de barriga</a>
  </div>

  <div class="busqueda-container">
    <input type="text" id="busqueda" placeholder=" Regitrar sintomas..." />
    <button onclick="buscarEnfermedad()">Buscar</button>
  </div>

  <script>
    function buscarEnfermedad() {
      const nombre = document.getElementById('busqueda').value;
      if (nombre.trim() !== '') {
        window.location.href = `/enfermedades?nombre=${encodeURIComponent(nombre)}`;
      }
    }
  </script>
</body>
</html>
