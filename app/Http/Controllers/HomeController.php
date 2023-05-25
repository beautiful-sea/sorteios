<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        if ($user->isAdmin()) {


            return view('pages.admin.home');
        }

        $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
        if(!$perguntas_frequentes){
            $perguntas_frequentes = new Configuration();
            $perguntas_frequentes->key = 'perguntas_frequentes';
            $perguntas_frequentes->value = json_encode([]);
            $perguntas_frequentes->save();
        }
        $perguntas_frequentes = json_decode($perguntas_frequentes->value);
        return view('pages.user.home',[
            'perguntas_frequentes' => $perguntas_frequentes
        ]);
    }
}
