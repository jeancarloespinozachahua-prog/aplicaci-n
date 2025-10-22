<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Historial de accesos</title>
  <style>
    /* Fondo galáctico con profundidad */
    body {
      margin: 0;
      padding: 40px;
      font-family: Arial, sans-serif;
      background: radial-gradient(circle at center, #0b0f2b, #1b2735, #000);
      overflow: hidden;
      color: white;
    }

    /* Galaxia animada con capas */
    .galaxia {
      position: fixed;
      top: -200px;
      left: -150px;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(255,0,255,0.2), rgba(0,255,255,0.1), transparent);
      border-radius: 50%;
      filter: blur(100px);
      animation: girarGalaxia 80s linear infinite;
      z-index: -3;
    }

    @keyframes girarGalaxia {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Mundo flotante con sombra y relieve */
    .mundo {
      position: fixed;
      bottom: 60px;
      left: 50%;
      transform: translateX(-50%);
      width: 320px;
      height: 160px;
      background: radial-gradient(circle at top, #4ed60a, #2f7300);
      border-radius: 50% 50% 40% 40% / 60% 60% 40% 40%;
      box-shadow:
        inset 0 -20px 40px rgba(0, 0, 0, 0.4),
        0 30px 60px rgba(0, 255, 0, 0.3),
        0 0 80px rgba(0, 255, 0, 0.2);
      z-index: -2;
      animation: flotar 6s ease-in-out infinite;
    }

    @keyframes flotar {
      0%, 100% { transform: translateX(-50%) translateY(0); }
      50% { transform: translateX(-50%) translateY(-10px); }
    }

    .mundo::after {
      content: "";
      position: absolute;
      bottom: -25px;
      left: 50%;
      transform: translateX(-50%);
      width: 280px;
      height: 40px;
      background: radial-gradient(ellipse at center, rgba(0,0,0,0.6), transparent);
      border-radius: 50%;
      opacity: 0.5;
    }

    /* Texto degradado animado */
    .texto-degradado {
      background: linear-gradient(270deg, #ff00cc, #00ffff, #ffff00, #ff00cc);
      background-size: 800% 800%;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: animarColor 8s ease infinite;
    }

    @keyframes animarColor {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    h1 {
      font-size: 2.2em;
      text-align: center;
      margin-bottom: 30px;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      background: rgba(214, 163, 10, 0.92);
      margin-bottom: 12px;
      padding: 12px 16px;
      border-left: 5px solid #007bffc4;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      color: #000;
      font-weight: bold;
      border-radius: 6px;
    }

    .empty {
      color: #ff4444;
      font-style: italic;
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
    
  <!-- Fondo mágico -->
  <div class="galaxia"></div>
  <div class="mundo"></div>

  <h1 class="texto-degradado">⚡ Historial de accesos</h1>

  @php
      if (!isset($logins) || $logins->isEmpty()) {
          $logins = collect([
              (object)['user_id' => 101, 'fecha_login' => '2025-10-14 08:32:10', 'ip' => '192.168.1.10'],
              (object)['user_id' => 102, 'fecha_login' => '2025-10-13 17:45:03', 'ip' => '192.168.1.11'],
              (object)['user_id' => 103, 'fecha_login' => '2025-10-12 09:15:22', 'ip' => '192.168.1.12'],
              (object)['user_id' => 104, 'fecha_login' => '2025-10-11 20:01:47', 'ip' => '192.168.1.13'],
              (object)['user_id' => 105, 'fecha_login' => '2025-10-10 07:22:33', 'ip' => '192.168.1.14'],
          ]);
      }
  @endphp

  @if ($logins->isEmpty())
    <p class="empty">No hay registros de acceso disponibles.</p>
  @else
    <ul>
      @foreach ($logins as $login)
        <li>
          <strong>Usuario ID:</strong> {{ $login->user_id }} |
          <strong>Fecha:</strong> {{ $login->fecha_login }} |
          <strong>IP:</strong> {{ $login->ip }}
        </li>
      @endforeach
    </ul>
  @endif
</body>
<div style="text-align:center; margin: 30px 0;">
  <input type="text" id="filtro" placeholder="Buscar por ID o IP..." style="padding:10px; border-radius:20px; width:250px;">
  <button onclick="filtrarAccesos()" style="padding:10px 20px; border-radius:20px; background:#00ffff; color:#000; font-weight:bold;">Filtrar</button>
</div>

<script>
  function filtrarAccesos() {
    const filtro = document.getElementById('filtro').value.toLowerCase();
    const items = document.querySelectorAll('li');
    items.forEach(item => {
      item.style.display = item.textContent.toLowerCase().includes(filtro) ? 'block' : 'none';
    });
  }
</script>
<div style="text-align:center; margin-bottom: 20px;">
  <button onclick="mostrarEstadisticas()" style="padding:10px 20px; border-radius:20px; background:#ff00cc; color:#fff; font-weight:bold;">📊 Ver estadísticas</button>
</div>

<script>
  function mostrarEstadisticas() {
    alert("Total de accesos: 5\nIPs únicas: 5\nÚltimo acceso: 2025-10-14");
  }
</script>
<nav style="position:fixed; top:0; left:0; width:100%; background:#1b2735; padding:10px 0; text-align:center; z-index:10;">
  <a href="{{ route('home') }}" style="margin:0 15px; color:#00ffff; font-weight:bold;">🏠 Inicio</a>
  <a href="{{ route('logins.index') }}" style="margin:0 15px; color:#00ffff; font-weight:bold;">📁 Accesos</a>
  <a href="{{ route('enfermedades.index') }}" style="margin:0 15px; color:#00ffff; font-weight:bold;">⚙️ Configuración</a>
</nav>

<div style="text-align:center; margin-top:20px;">
  <button onclick="cambiarFondo()" style="padding:10px 20px; border-radius:20px; background:#ffff00; color:#000; font-weight:bold;">🌗 Cambiar fondo</button>
</div>

<script>
  function cambiarFondo() {
    document.body.style.background = 'radial-gradient(circle at center, #000428, #004e92, #6a00ff, #ff00cc, #00ffff)';
  }
</script>


</html>
