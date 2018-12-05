<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $last = Event::query()
            ->where('type', Event::TYPE_EVENT)
            ->orderByDesc('date')
            ->first();
        
        $others = Event::query()
            ->where('type', Event::TYPE_EVENT)
            ->orderByDesc('date')
            ->when(!empty($last), function($query) use($last){
                return $query->where('id', '<>', $last->id);
            })
            ->paginate(6);
        
        return view('front.events.index', compact(['last', 'others']));
    }
	
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id = null)
	{
	    $event = Event::findOrFail($id);
	    
		return view('front.events.show', compact('event'));
	}
}
