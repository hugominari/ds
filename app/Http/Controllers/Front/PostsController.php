<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.posts.index');
    }
	
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
		return view('front.posts.show');
	}
}