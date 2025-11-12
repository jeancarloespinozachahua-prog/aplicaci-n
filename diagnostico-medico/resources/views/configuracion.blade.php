<h5 class="text-uppercase fw-bold text-secondary mb-3">🛠️ Configuración del sistema</h5>

<div class="config-section">
    <ul class="config-list">
        <li><a href="{{ route('configuracion.nombre') }}">📝 Editar nombre</a></li>
        <li><a href="{{ route('configuracion.idioma') }}">🌐 Cambiar idioma</a></li>
        <li><a href="{{ route('configuracion.tema') }}">🎨 Tema visual</a></li>
    </ul>

    <ul class="config-list mt-3">
        <li><a href="{{ route('configuracion.datos') }}">📇 Actualizar datos personales</a></li>
        <li><a href="{{ route('configuracion.historial') }}">📋 Historial clínico</a></li>
        <li><a href="{{ route('configuracion.preferencias') }}">⚕️ Preferencias de diagnóstico</a></li>
    </ul>
</div>

<style>
.config-section {
    background: linear-gradient(to bottom, #f9f9f9, #e3f2fd);
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: background 0.3s ease;
}

.config-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.config-list li {
    margin-bottom: 10px;
}

.config-list a {
    display: block;
    padding: 12px 16px;
    background-color: #ffffff;
    border-radius: 8px;
    color: #333;
    font-weight: 500;
    text-decoration: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.config-list a:hover {
    background-color: #d1ecf1;
    color: #007bff;
    transform: translateX(4px);
}

.config-list a:active {
    background-color: #b2ebf2;
    color: #0056b3;
}

/* Modo oscuro */
body.dark-mode .config-section {
    background: linear-gradient(to bottom, #1e1e1e, #2c2c2c);
    box-shadow: 0 0 10px rgba(255,255,255,0.05);
}

body.dark-mode .config-list a {
    background-color: #2c2c2c;
    color: #f0f0f0;
}

body.dark-mode .config-list a:hover {
    background-color: #333;
    color: #80d8ff;
}
</style>
