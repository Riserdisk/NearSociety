@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Eventos Disponibles</h2>
        </div>
        @foreach ($availableEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">{!! $event->description !!}</p>
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <p class="card-text">{{ $event->location }}</p>
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
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

    <div class="row mt-5">
        <div class="col-12">
            <h2>Eventos Cancelados</h2>
        </div>
        @foreach ($cancelledEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">{!! $event->description !!}</p>
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <p class="card-text">{{ $event->location }}</p>
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
                        <button type="button" class="btn btn-danger" disabled>
                            Cancelado
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h2>Eventos No Disponibles</h2>
        </div>
        @foreach ($unavailableEvents as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->name }}</h5>
                        <p class="card-text">{!! $event->description !!}</p>
                        <p class="card-text"><small class="text-muted">{{ $event->date }} {{ $event->time }}</small></p>
                        <p class="card-text">{{ $event->location }}</p>
                        @if ($event->user)
                            <p><strong>Operador:</strong> {{ $event->user->name }}</p>
                        @else
                            <p><strong>Operador:</strong> Desconocido</p>
                        @endif
                        @if ($event->requires_max_attendees)
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }} / {{ $event->max_attendees }}</p>
                        @else
                            <p class="card-text">Asistentes: {{ $event->attendees->count() }}</p>
                        @endif
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
