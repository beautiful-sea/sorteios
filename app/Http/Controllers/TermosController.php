<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class TermosController extends Controller
{
    public function index(){
        $termos = Configuration::where('key','termos')->first();
        return view('pages.public.terms')->with('termos',$termos);
    }
}
