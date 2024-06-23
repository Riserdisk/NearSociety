@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2>Notificaciones</h2>
            <ul class="list-group">
                @foreach ($notifications as $notification)
                    <li class="list-group-item {{ $notification->read_at ? 'list-group-item-secondary' : 'list-group-item-primary' }}">
                        {{ $notification->message }}
                        @if (!$notification->read_at)
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="float-right">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-outline-success">Marcar como leído</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
