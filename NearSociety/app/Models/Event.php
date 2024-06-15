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
    ];

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_attendees');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
