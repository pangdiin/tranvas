<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Event\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->format('Y-m-d');

    	$upcomingEvents = Event::where('end_date', '>', $today)
    		->orderBy('start_date', 'desc')
    		->get();

    	$pastEvents = Event::where('end_date', '<', $today)
    		->orderBy('start_date', 'desc')
    		->limit(3)
    		->get();

    	return view('event.event-list', compact('upcomingEvents', 'pastEvents'));
    }

    public function view(Event $event)
    {
        return view('event.event-view', compact('event'));
    }
}
