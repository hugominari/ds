<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class AgreementsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.agreements');
    }
}
