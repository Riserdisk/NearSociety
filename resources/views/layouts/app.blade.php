<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NearSociety')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body, .navbar {
            background-color: #333; /* Color de fondo oscuro */
            color: #fff; /* Color de texto claro */
        }
        a {
            color: #80f5f5; /* Color de los enlaces */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NearSociety</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="">Login Vecino</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('voyager.login') }}">Login Operador</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="">Logout</a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
