<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventAttendeeController extends Controller
{
    public function attend($eventId)
    {
        $event = Event::findOrFail($eventId);

        if (!$event->requires_max_attendees || $event->attendees->count() < $event->max_attendees) {
            $event->attendees()->attach(Auth::id());
        }

        return redirect()->route('events.index')->with('success', 'Has confirmado tu asistencia.');
    }
}
