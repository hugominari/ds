<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Covenant;

class AgreementsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $covenants = Covenant::paginate(10);
        
        return view('front.agreements', compact(['covenants']));
    }
}
