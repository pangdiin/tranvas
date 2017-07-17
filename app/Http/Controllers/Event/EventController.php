<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Event\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function add()
    {
        return view('event.event-add');
    }

    public function store(Request $request)
    {

        dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'lat' => $request->input('lat'),
            'long' => $request->input('lng'),
            'user_id' => $request->user()->id,
            // 'slug' => Str::slug($request->input('title')),
        ]);

        // return redirect()->route('events');
        return redirect()->back();

    }
}
