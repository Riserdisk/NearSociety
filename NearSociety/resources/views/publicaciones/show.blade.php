@extends('layouts.plantilla')

@section('title', 'Show' . $publicacion)
@section('name')
    <h1>Aqui se ve la publicacion: {{$publicacion}}</h1>    
@endsection