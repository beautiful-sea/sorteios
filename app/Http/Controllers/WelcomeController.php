<?php

namespace App\Http\Controllers;

use App\Models\Rifa;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $rifas = Rifa::all();
        return view('pages.public.home')->with(['rifas'   =>  $rifas]);
    }
}
