<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modelo de notificaciones
class Notification extends Model
{
    use HasFactory;

    // Campos que se pueden modificar
    protected $fillable = [
        'user_id',
        'event_id',
        'message',
        'read_at'
    ];

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
