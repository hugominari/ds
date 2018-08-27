<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.index');
    }
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function internalRules()
	{
		return view('front.internal-rules');
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function history()
	{
		return view('front.history');
	}
}
