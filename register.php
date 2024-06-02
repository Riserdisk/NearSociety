@extends('layouts.app')
@section('content')
<script src="funcions/validacion.js" defer></script> <!-- Agregar el archivo de validación JavaScript -->
<h2>Formulario de Registro</h2>
<form id="registroForm" action="#" method="post">
    <label for="user">User:</label><br>
    <input type="text" id="user" name="user" required><br>
    <label for="contrasena">Contraseña:</label><br>
    <input type="password" id="contrasena" name="contrasena" required><br>
    <label for="confirmarContrasena">Confirmar Contraseña:</label><br>
    <input type="password" id="confirmarContrasena" name="confirmarContrasena" required><br>
    <button type="submit">Registrarse</button>
</form>
@endsection