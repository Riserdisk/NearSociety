@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Eventos Disponibles</h2>
        </div>
        <!-- Iterar sobre los eventos disponibles -->
        @foreach ($availableEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Mostrar el nombre del evento -->
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <!-- Mostrar la descripción del evento (Rich Text) -->
                        <p class="card-text">{!! $event->description !!}</p>
                        <!-- Mostrar la fecha y hora del evento -->
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <!-- Mostrar la ubicación del evento -->
                        <p class="card-text">{{ $event->location }}</p>
                        <!-- Mostrar el nombre del operador que creó el evento -->
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        <!-- Mostrar la cantidad de asistentes si se requiere máximo de asistentes -->
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
                        <!-- Formulario para confirmar asistencia al evento -->
                        <form method="POST" action="{{ route('events.attend', $event->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary" {{ $event->attendees->contains(auth()->user()->id) ? 'disabled' : '' }}>
                                {{ $event->attendees->contains(auth()->user()->id) ? 'Asistiendo' : 'Asistiré' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sección de eventos cancelados -->
    <div class="row mt-5">
        <div class="col-12">
            <h2>Eventos Cancelados</h2>
        </div>
        <!-- Iterar sobre los eventos cancelados -->
        @foreach ($cancelledEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Mostrar el nombre del evento -->
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <!-- Mostrar la descripción del evento (Rich Text) -->
                        <p class="card-text">{!! $event->description !!}</p>
                        <!-- Mostrar la fecha y hora del evento -->
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <!-- Mostrar la ubicación del evento -->
                        <p class="card-text">{{ $event->location }}</p>
                        <!-- Mostrar el nombre del operador que creó el evento -->
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        <!-- Mostrar la cantidad de asistentes si se requiere máximo de asistentes -->
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
                        <!-- Botón deshabilitado para indicar que el evento está cancelado -->
                        <button type="button" class="btn btn-danger" disabled>
                            Cancelado
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sección de eventos no disponibles -->
    <div class="row mt-5">
        <div class="col-12">
            <h2>Eventos No Disponibles</h2>
        </div>
        <!-- Iterar sobre los eventos no disponibles -->
        @foreach ($unavailableEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Mostrar el nombre del evento -->
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <!-- Mostrar la descripción del evento (Rich Text) -->
                        <p class="card-text">{!! $event->description !!}</p>
                        <!-- Mostrar la fecha y hora del evento -->
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <!-- Mostrar la ubicación del evento -->
                        <p class="card-text">{{ $event->location }}</p>
                        <!-- Mostrar el nombre del operador que creó el evento -->
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        <!-- Mostrar la cantidad de asistentes si se requiere máximo de asistentes -->
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
                        <!-- Botón deshabilitado para indicar que el evento no está disponible -->
                        <button type="button" class="btn btn-secondary" disabled>
                            No Disponible
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
