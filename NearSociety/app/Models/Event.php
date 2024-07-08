<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'time',
        'description',
        'location',
        'user_id',
        'requires_max_attendees',
        'max_attendees',
        'status',
    ];

    // Relación con el modelo User a través de la tabla event_attendees para ver los asistentes
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
