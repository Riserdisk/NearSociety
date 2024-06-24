<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        // Obtener todos los eventos con las relaciones necesarias
        $events = Event::with(['attendees', 'user'])->orderBy('created_at', 'desc')->get();

        // Obtener la fecha y hora actual
        $now = Carbon::now();

        // Separar los eventos en disponibles y no disponibles
        $availableEvents = $events->filter(function ($event) use ($now) {
            return (!$event->requires_max_attendees || $event->attendees->count() < $event->max_attendees) && $event->date . ' ' . $event->time >= $now;
        });

        $unavailableEvents = $events->filter(function ($event) use ($now) {
            return ($event->requires_max_attendees && $event->attendees->count() >= $event->max_attendees) || $event->date . ' ' . $event->time < $now;
        });

        // Pasar las dos listas de eventos a la vista
        return view('index', compact('availableEvents', 'unavailableEvents'));
    }
}
