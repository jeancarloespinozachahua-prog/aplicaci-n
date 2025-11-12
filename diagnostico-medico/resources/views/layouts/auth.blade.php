<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al sistema</title>

    <!-- Estilos embebidos sin Vite -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #1e1e2f;
            color: #f0f0f0;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>
