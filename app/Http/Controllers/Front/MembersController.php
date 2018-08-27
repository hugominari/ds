<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.directors');
    }
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function fiscals()
	{
		return view('front.fiscals');
	}
}
