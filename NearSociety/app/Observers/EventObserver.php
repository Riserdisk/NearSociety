<?php
namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventObserver
{
    /**
     * Handle the Event "creating" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */

     // Método para asignar el id del usuario autenticado al evento que se está creando
    public function creating(Event $event)
    {
        if (Auth::check()) {
            $event->user_id = Auth::id();
        }
    }
}