<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class EventsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.events.index');
    }
	
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
		return view('front.events.show');
	}
}
