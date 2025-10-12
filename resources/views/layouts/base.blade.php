<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COCOMO - @yield('title', 'Estimación de Software')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- tailwind css -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Importamos el font-family de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col" style="font-family: Roboto;">
    <header>
        <nav class="flex items-center bg-lime-600 h-8 font-bold">
            <div class="container flex mx-auto">
                <a href="{{ url('/') }}" class="navbar-brand">COCOMO</a>
                <div class="grow"></div>
                <ul class="flex gap-10">
                    <li><a href="{{ url('/') }}" class="hover:underline">Inicio</a></li>
                    <li><a href="{{ route('estimacion.basica') }}" class="hover:underline">Estimación Básica</a></li>
                    <li><a href="{{ route('estimacion.intermedia') }}" class="hover:underline">Estimación Intermedia</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="container flex-1">
        @yield('content')
    </main>
    <footer class="flex items-center text-center bg-lime-600 h-8 font-bold">
        <div class="container">
            <p>&copy; {{ date('Y') }} COCOMO - UTN:FRRe. Sede Formosa</p>
        </div>
    </footer>
</body>
</html>