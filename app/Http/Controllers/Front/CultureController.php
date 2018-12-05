<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Event;

class CultureController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cultures = Event::query()->where('type', Event::TYPE_CULTURES)->paginate(4);
        return view('front.culture', compact(['cultures']));
    }
}
