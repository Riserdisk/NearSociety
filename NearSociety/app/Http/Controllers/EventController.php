<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['attendees', 'user'])->get();
        return view('index', compact('events'));
    }
}
