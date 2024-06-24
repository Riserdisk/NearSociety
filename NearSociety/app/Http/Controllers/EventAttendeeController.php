<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controlador para la asistencia a eventos
class EventAttendeeController extends Controller
{
    // Método para confirmar la asistencia a un evento
    public function attend($eventId)
    {
        // Buscar el evento por su id
        $event = Event::findOrFail($eventId);

        // Si el evento no requiere un número máximo de asistentes o si el número de asistentes es menor al máximo permitido
        if (!$event->requires_max_attendees || $event->attendees->count() < $event->max_attendees) {
            $event->attendees()->attach(Auth::id());
        }

        // Redirigir a la lista de eventos con un mensaje de éxito
        return redirect()->route('events.index')->with('success', 'Has confirmado tu asistencia.');
    }
}