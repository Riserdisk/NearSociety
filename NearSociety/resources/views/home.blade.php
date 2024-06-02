@extends('layouts.plantilla')
@section('title', 'Home')
@section('content')
    <h1>"Bienvennido a la pagina principal"</h1>
    <p>esta es una version de prueba de la pagina</p>
    
    <form>
        <button type="button" onclick="window.location.href='{{ route('vecino.login') }}'" class="btn btn-primary">Iniciar sesión como vecino</button>
        <button type="button" onclick="window.location.href='{{ route('voyager.login') }}'">Iniciar sesión como operador</button>
        <button type="button" onclick="window.location.href='/register'">Registrarse</button>
    </form>


@endsection