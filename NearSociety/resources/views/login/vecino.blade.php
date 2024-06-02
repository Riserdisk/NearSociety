@extends('layouts.plantilla')

@section('content')
    <h1>Inicio de sesion de vecinos</h1>
    <form method="POST" action="{{ route('vecino.login') }}">
        @csrf
        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
    
@endsection

@error('record')
@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@enderror