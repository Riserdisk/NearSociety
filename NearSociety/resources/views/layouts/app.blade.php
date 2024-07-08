<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags para configurar el documento -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Título de la página, que se puede cambiar dinámicamente -->
    <title>@yield('title') - NearSociety</title>

    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a la hoja de estilos personalizada -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Enlace a la hoja de estilos para el modo oscuro, deshabilitada por defecto -->
    <link href="{{ asset('css/dark-mode.css') }}" rel="stylesheet" id="dark-mode-css" disabled>
</head>
<body>
    <div id="app">
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <!-- Logo de la marca que enlaza a la página principal -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    NearSociety
                </a>
                <!-- Botón para colapsar la barra de navegación en pantallas pequeñas -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado izquierdo de la barra de navegación -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Lado derecho de la barra de navegación -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Enlaces de autenticación -->
                        @guest
                            <!-- Mostrar el enlace de "Iniciar Sesión" si el usuario es un invitado -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('neighbor.login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                        @else
                            <!-- Menú desplegable para usuarios autenticados -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!-- Enlace para cerrar sesión -->
                                    <a class="dropdown-item" href="{{ route('neighbor.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <!-- Enlace para alternar el modo oscuro -->
                                    <a class="dropdown-item" href="#" id="toggle-dark-mode">
                                        {{ __('Alternar Modo Oscuro') }}
                                    </a>

                                    <!-- Formulario oculto para cerrar sesión -->
                                    <form id="logout-form" action="{{ route('neighbor.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" async></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleDarkModeBtn = document.getElementById('toggle-dark-mode');
            const darkModeCss = document.getElementById('dark-mode-css');
            const body = document.body;

            // Función para habilitar el modo oscuro
            const enableDarkMode = () => {
                darkModeCss.removeAttribute('disabled');
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            };

            // Función para deshabilitar el modo oscuro
            const disableDarkMode = () => {
                darkModeCss.setAttribute('disabled', 'true');
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            };

            // Comprobar el estado del modo oscuro en el almacenamiento local
            if (localStorage.getItem('darkMode') === 'enabled') {
                enableDarkMode();
            }

            // Añadir un evento al botón para alternar el modo oscuro
            toggleDarkModeBtn.addEventListener('click', () => {
                if (darkModeCss.disabled) {
                    enableDarkMode();
                } else {
                    disableDarkMode();
                }
            });
        });
    </script>
</body>
</html>
