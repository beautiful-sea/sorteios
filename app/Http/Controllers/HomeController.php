<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }

        return view('pages.user.home');
    }
}
