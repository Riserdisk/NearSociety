<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - NearSociety</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Dark Mode CSS -->
    <link href="{{ asset('css/dark-mode.css') }}" rel="stylesheet" id="dark-mode-css" disabled>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    NearSociety
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('neighbor.login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('neighbor.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <a class="dropdown-item" href="#" id="toggle-dark-mode">
                                        {{ __('Alternar Modo Oscuro') }}
                                    </a>

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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" async></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleDarkModeBtn = document.getElementById('toggle-dark-mode');
            const darkModeCss = document.getElementById('dark-mode-css');
            const body = document.body;

            const enableDarkMode = () => {
                darkModeCss.removeAttribute('disabled');
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            };

            const disableDarkMode = () => {
                darkModeCss.setAttribute('disabled', 'true');
                body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'disabled');
            };

            if (localStorage.getItem('darkMode') === 'enabled') {
                enableDarkMode();
            }

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

