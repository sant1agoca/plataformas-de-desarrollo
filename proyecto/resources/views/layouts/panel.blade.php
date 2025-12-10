<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de Administración')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="container mt-4">
        <h2>Panel de Administración</h2>
        <nav class="d-flex gap-3 align-items-center mb-3">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary btn-sm">
                Usuarios
            </a>
            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-success btn-sm">
                Nuevo Usuario
            </a>
            <a href="{{ route('proyectos.index') }}" class="btn btn-outline-primary btn-sm">
                Proyectos
            </a>
            <a href="{{ route('proyectos.create') }}" class="btn btn-outline-success btn-sm">
                Nuevo Proyecto
            </a>

            <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                @csrf
                <button class="btn btn-danger btn-sm">Cerrar Sesión</button>
            </form>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="text-center mt-5">
        <small>© {{ date('Y') }} Plataformas de Desarrollo de Software</small>
    </footer>
</body>
</html>