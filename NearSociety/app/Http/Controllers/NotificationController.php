<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controllador para las notificaciones
class NotificationController extends Controller
{
    // Función para mostrar las notificaciones
    public function index()
    {
        // Se obtienen las notificaciones del usuario autenticado
        $notifications = Notification::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();
        // Se retorna la vista con las notificaciones
        return view('notifications.index', compact('notifications'));
    }

    // Función para marcar una notificación como leída
    public function markAsRead($id)
    {
        // Se obtiene la notificación
        $notification = Notification::where('user_id', Auth::id())
                                    ->where('id', $id)
                                    ->firstOrFail();

        // Se marca la notificación como leída
        $notification->read_at = now();
        $notification->save();

        // Se redirige a la página anterior
        return redirect()->back();
    }
}
