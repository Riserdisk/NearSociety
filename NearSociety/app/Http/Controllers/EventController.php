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

        // Separar los eventos en disponibles, cancelados y no disponibles
        $availableEvents = $events->filter(function ($event) use ($now) {
            return $event->status == 'disponible' && (!$event->requires_max_attendees || $event->attendees->count() < $event->max_attendees) && $event->date . ' ' . $event->time >= $now;
        });

        $cancelledEvents = $events->filter(function ($event) {
            return $event->status == 'cancelado';
        });

        $unavailableEvents = $events->filter(function ($event) use ($now) {
            return $event->status == 'no disponible' || ($event->requires_max_attendees && $event->attendees->count() >= $event->max_attendees) || $event->date . ' ' . $event->time < $now;
        });

        // Pasar las tres listas de eventos a la vista
        return view('index', compact('availableEvents', 'cancelledEvents', 'unavailableEvents'));
    }
}
