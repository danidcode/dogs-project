<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dogs project</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/scss/main.scss', 'resources/js/app.js'])
</head>
@php
$routeName = Route::current()->getName()
@endphp

<body>
    <header class="header">
    </header>
    <div id="main" class="main">
        <div class="sidebar">
            <a class=" href="/dashboard">Home</a>
            <a class=""" href="/admin/actividades">Configurar Actividades</a>
            <a class="ndif" href="/admin/eventos">Configurar Eventos</a>
            <a class="endif" href="/admin/reservas">Configurar Reservas</a>
            <a class="ve" href="/admin/inscripciones">Configurar Inscripciones</a>
            <a class="tive" href="#about">Modificar datos</a>
            <a class="" href="/">Volver a la página principal</a>
            <a class="" href="#about">Cerrar sesión <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
        @yield('content')
    </div>

    <footer class="footer">
        @include('components.footer')
    </footer>
</body>

@include('global-scripts.index')

@yield('scripts')

</html>