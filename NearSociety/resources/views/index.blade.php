@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($events as $event)
            @if (!$event->requires_max_attendees || $event->attendees->count() < $event->max_attendees)
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
            @endif
        @endforeach
    </div>
</div>
@endsection
