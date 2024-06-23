<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Controlador para los eventos
class EventController extends Controller
{
    // Mostrar la vista principal
    public function index()
    {
        // Obtener la fecha y hora actual
        $currentDateTime = Carbon::now();

        // Obtener los eventos disponibles
        $availableEvents = Event::where(DB::raw('CONCAT(date, " ", time)'), '>', $currentDateTime)
                                ->where(function ($query) {
                                    $query->where('max_attendees', '>', 'attendees_count')
                                          ->orWhereNull('max_attendees');
                                })
                                ->orderBy('created_at', 'desc')
                                ->get();
        // Obtener los eventos no disponibles                      
        $unavailableEvents = Event::where(DB::raw('CONCAT(date, " ", time)'), '<=', $currentDateTime)
                                  ->orWhere('max_attendees', '<=', 'attendees_count')
                                  ->orderBy('created_at', 'desc')
                                  ->get();
        // Obtener las notificaciones del usuario                        
        $notifications = Notification::where('user_id', auth()->id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        // Retornar la vista principal con los eventos disponibles, no disponibles y las notificaciones                        
        return view('index', compact('availableEvents', 'unavailableEvents', 'notifications'));
    }

    // Mostrar la vista para crear un evento
    public function store(Request $request)
    {
        // Validar los datos del evento
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'requires_max_attendees' => 'required|boolean',
            'max_attendees' => 'nullable|integer|min:1'
        ]);
        // Crear el evento
        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'requires_max_attendees' => $validated['requires_max_attendees'],
            'max_attendees' => $validated['max_attendees'],
            'user_id' => Auth::id()
        ]);

        // Crear notificación para todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'message' => 'Se ha creado un nuevo evento: ' . $event->name
            ]);
        }
        // Redirigir a la vista principal
        return redirect()->route('index');
    }

    // Mostrar la vista para crear un evento    
    public function attend($id)
    {
        // Obtener el evento y el usuario
        $event = Event::findOrFail($id);
        $user = auth()->user();
        //  Verificar si el usuario ya está participando en el evento
        if (!$event->attendees->contains($user->id)) {
            $event->attendees()->attach($user->id);

            // Crear notificaciones para el usuario
            Notification::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'message' => 'Estás participando en el evento: ' . $event->name
            ]);

            // Crear notificación para un día antes del evento
            $oneDayBefore = Carbon::parse($event->date . ' ' . $event->time)->subDay();
            if ($oneDayBefore->greaterThan(Carbon::now())) {
                Notification::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'message' => 'Falta un día para el evento: ' . $event->name,
                    'created_at' => $oneDayBefore,
                ]);
            }

            // Crear notificación para media hora antes del evento
            $halfHourBefore = Carbon::parse($event->date . ' ' . $event->time)->subMinutes(30);
            if ($halfHourBefore->greaterThan(Carbon::now())) {
                Notification::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'message' => 'Falta media hora para el evento: ' . $event->name,
                    'created_at' => $halfHourBefore,
                ]);
            }

            // Crear notificación para cuando termine el evento
            $eventEnd = Carbon::parse($event->date . ' ' . $event->time)->addHours(2); // Suponiendo que el evento dura 2 horas
            if ($eventEnd->greaterThan(Carbon::now())) {
                Notification::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'message' => 'El evento ha terminado: ' . $event->name,
                    'created_at' => $eventEnd,
                ]);
            }
        }
        // Redirigir a la vista principal
        return redirect()->route('index');
    }
}
