<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <header>
        <h2>Sistema de Usuarios</h2>
        <nav>
            <a href="{{ route('usuarios.index') }}">Inicio</a> | 
            <a href="{{ route('usuarios.create') }}">Nuevo Usuario</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <small>© {{ date('Y') }} UAM - Plataforma de Desarrollo de Software</small>
    </footer>
</body>
</html>