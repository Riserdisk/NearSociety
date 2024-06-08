@extends('layouts.app')

@section('title', 'Bienvenido a NearSociety')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido a NearSociety</div>

                <div class="card-body">
                    <a href="{{ route('neighbor.login') }}" class="btn btn-primary">Iniciar Sesión como Vecino</a>
                    <a href="{{ route('voyager.login') }}" class="btn btn-secondary">Iniciar como Operador</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection