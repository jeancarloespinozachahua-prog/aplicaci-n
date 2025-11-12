<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GlucoSense - Diagnóstico Médico</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #ffffff);
            background-attachment: fixed;
            transition: background 0.3s ease;
        }

        .navbar {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: background 0.3s ease;
        }

        #sidebar {
            transition: all 0.4s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(to bottom, #f8f9fa, #e3f2fd);
            border-right: 1px solid #dee2e6;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(-30px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .hidden-sidebar {
            transform: translateX(-100%);
            opacity: 0;
            pointer-events: none;
        }

        #mainContent {
            transition: all 0.4s ease;
        }

        .rotate-icon {
            transition: transform 0.4s ease;
            transform: rotate(180deg);
        }

        .nav-link {
            padding: 12px 20px;
            color: #0056b3;
            font-weight: 500;
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .nav-link:hover {
            background-color: #d1ecf1;
            color: #007bff;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        }

        .card-header {
            font-weight: bold;
            font-size: 1.1rem;
            background: linear-gradient(to right, #007bff, #00bcd4);
            color: white;
            border-bottom: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        #toggleMenu {
            border: none;
            background: transparent;
            color: white;
            font-size: 1.2rem;
        }

        .scrollable-menu {
            max-height: calc(100vh - 56px);
            overflow-y: auto;
            scroll-behavior: smooth;
        }

        @media (max-width: 768px) {
            #sidebar {
                display: none !important;
            }
            #mainContent {
                width: 100% !important;
            }
        }

        /* Modo oscuro */
        body.dark-mode {
            background: linear-gradient(to bottom right, #1e1e1e, #2c2c2c);
            color: #f0f0f0;
        }

        body.dark-mode .navbar {
            background-color: #212121 !important;
        }

        body.dark-mode #sidebar {
            background: linear-gradient(to bottom, #2c2c2c, #1e1e1e);
            border-right: 1px solid #444;
        }

        body.dark-mode .nav-link {
            color: #f0f0f0;
            border-bottom: 1px solid #444;
        }

        body.dark-mode .nav-link:hover {
            background-color: #333;
            color: #80d8ff;
        }

        body.dark-mode .nav-link.active {
            background-color: #2196f3;
            color: #fff;
        }

        body.dark-mode .card-header {
            background: linear-gradient(to right, #2196f3, #00acc1);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Barra superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="/">🩺 GlucoSense</a>
        </div>
    </nav>

    <!-- Estructura principal -->
    <div class="container-fluid">
        <div class="row">
            @if (!request()->routeIs('login.formulario'))
                <!-- Menú lateral -->
                <div id="sidebar" class="col-md-3 p-0">
                    <div class="card border-0 rounded-0 h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-gear-fill me-2"></i>Opciones del sistema</span>
                            <button id="toggleMenu" class="btn btn-sm btn-light text-primary">
                                <i class="bi bi-chevron-left" id="toggleIcon"></i>
                            </button>
                        </div>
                        <div class="card-body p-0 scrollable-menu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('diagnostico.index') ? 'active' : '' }}" href="{{ route('diagnostico.index') }}">
                                        <i class="bi bi-house-door-fill"></i>Inicio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('configuracion') ? 'active' : '' }}" href="{{ route('configuracion') }}">
                                        <i class="bi bi-sliders"></i>Configuración
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('perfil') ? 'active' : '' }}" href="{{ route('perfil') }}">
                                        <i class="bi bi-person-circle"></i>Perfil
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('soporte') ? 'active' : '' }}" href="{{ route('soporte') }}">
                                        <i class="bi bi-life-preserver"></i>Soporte
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('cerrar') ? 'active' : '' }}" href="{{ route('cerrar') }}">
                                        <i class="bi bi-box-arrow-right"></i>Cerrar sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div id="mainContent" class="col-md-9 py-4">
                    @yield('content')
                </div>
            @else
                <!-- Solo contenido sin menú lateral -->
                <div class="col-md-12 py-4">
                    @yield('content')
                </div>
            @endif
        </div>
    </div>

    <!-- Script para mostrar/ocultar menú con animación y memoria -->
    <script>
        const toggleBtn = document.getElementById('toggleMenu');
        const sidebar = document.getElementById('sidebar');
        const icon = document.getElementById('toggleIcon');
        const mainContent = document.getElementById('mainContent');

        // Restaurar estado desde localStorage
        if (localStorage.getItem('menuOculto') === 'true') {
            sidebar.classList.add('hidden-sidebar');
            icon.classList.remove('bi-chevron-left');
            icon.classList.add('bi-chevron-right', 'rotate-icon');
            mainContent.classList.remove('col-md-9');
            mainContent.classList.add('col-md-12');
        }

        // Evento de ocultar/mostrar
        toggleBtn.addEventListener('click', () => {
            const isHidden = sidebar.classList.toggle('hidden-sidebar');
            icon.classList.toggle('bi-chevron-left');
            icon.classList.toggle('bi-chevron-right');
            icon.classList.toggle('rotate-icon');

            if (isHidden) {
                mainContent.classList.remove('col-md-9');
                mainContent.classList.add('col-md-12');
                localStorage.setItem('menuOculto', 'true');
            } else