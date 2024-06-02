@extends('layouts.app')

@section('title', 'Eventos de la Comunidad')

@section('content')
    <div class="container mt-4">
        <h1>Eventos de la Comunidad</h1>
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p><strong>Fecha:</strong> {{ $event->date }}</p>
                            <p><strong>Hora:</strong> {{ $event->time }}</p>
                            <p><strong>Lugar:</strong> {{ $event->location }}</p>
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
