<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COCOMO - @yield('title', 'Estimación de Software')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">COCOMO</a>
            <ul>
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ route('estimacion.basica') }}">Estimación Básica</a></li>
                <li><a href="{{ route('estimacion.intermedia') }}">Estimación Intermedia</a></li>
            </ul>
        </div>
    </nav>
    <main class="container">
        @yield('content')
    </main>
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} COCOMO - UTN:FRRe. Sede Formosa</p>
        </div>
    </footer>
</body>
</html>