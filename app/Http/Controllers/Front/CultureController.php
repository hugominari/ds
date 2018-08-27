<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CultureController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.culture');
    }
}
