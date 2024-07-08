@extends('layouts.app')

<!-- Sección para definir el título de la página -->
@section('title', 'Iniciar Sesión')

<!-- Sección para el contenido principal de la página -->
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Encabezado de la tarjeta -->
                <div class="card-header">{{ __('Iniciar Sesión') }}</div>

                <!-- Cuerpo de la tarjeta -->
                <div class="card-body">
                    <!-- Formulario de inicio de sesión -->
                    <form method="POST" action="{{ route('neighbor.login') }}">
                        @csrf <!-- Token de seguridad para proteger contra ataques CSRF -->

                        <!-- Grupo de formulario para el campo de correo electrónico -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <!-- Campo de entrada para el correo electrónico -->
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                <!-- Mostrar error si existe -->
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Grupo de formulario para el campo de contraseña -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <!-- Campo de entrada para la contraseña -->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                <!-- Mostrar error si existe -->
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Grupo de formulario para la opción "Recuérdame" -->
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <!-- Checkbox para la opción "Recuérdame" -->
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Grupo de formulario para el botón de enviar -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <!-- Botón para enviar el formulario -->
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection 
