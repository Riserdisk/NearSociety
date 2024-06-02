@extends('layouts.app')

@section('title', 'Bienvenido a NearSociety')

@section('content')
    <div class="jumbotron mt-4">
        <h1 class="display-4">Bienvenido a NearSociety</h1>
        <p class="lead">Una plataforma para mantener a la comunidad informada y conectada.</p>
        <hr class="my-4">
        <p>Inicia sesión para ver más detalles y participar en los eventos de la comunidad.</p>
        <a class="btn btn-primary btn-lg" href="" role="button">Login Vecino</a>
        <a class="btn btn-secondary btn-lg" href="{{ route('voyager.login') }}" role="button">Login Operador</a>
    </div>
@endsection



    