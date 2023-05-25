<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfiguracoesController extends Controller
{
    public function index(){
        return view('pages.admin.configuracoes.index');
    }

    public function getTermos(){
        $termos = Configuration::where('key','termos')->first();
        return response()->json($termos);
    }

    public function updateTermos(Request $request){
        $termos = Configuration::where('key','termos')->first();
        if($termos == null){
            $termos = new Configuration();
            $termos->key = 'termos';
        }
        $termos->value = $request->termos['value'];
        $termos->save();
        return response()->json($termos);
    }

    public function getMetodoPagamento(){
        $metodo_pagamento = Configuration::where('key','metodo_pagamento')->first();
        return response()->json($metodo_pagamento);
    }

    public function updateMetodoPagamento(Request $request){
        $metodo_pagamento = Configuration::where('key','metodo_pagamento')->first();
        if($metodo_pagamento == null){
            $metodo_pagamento = new Configuration();
            $metodo_pagamento->key = 'metodo_pagamento';
        }
        $metodo_pagamento->value = $request->metodo_pagamento['value'];
        $metodo_pagamento->save();
        return response()->json($metodo_pagamento);
    }

    public function getPerguntasFrequentes(){
        $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
        if(!$perguntas_frequentes){
            $perguntas_frequentes = new Configuration();
            $perguntas_frequentes->key = 'perguntas_frequentes';
            $perguntas_frequentes->value = json_encode([]);
            $perguntas_frequentes->save();
        }

        return response()->json(json_decode($perguntas_frequentes->value));
    }

    public function storePerguntasFrequentes(Request $request){
        $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
        $data = [
            'id'    =>  uniqid(),
            'pergunta' => $request->pergunta,
            'resposta' => $request->resposta,
            'ordem' => $request->ordem,
            //data d/m/Y H:i:s
            'created_at' => date('d/m/Y H:i:s'),
        ];
        $perguntas_frequentes->value = json_encode(array_merge(json_decode($perguntas_frequentes->value),[$data]));
        $perguntas_frequentes->save();

        return response()->json(json_decode($perguntas_frequentes->value));
    }

    public function updatePerguntaFrequente(Request $request){
        $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
        $data = [
            'id'    =>  $request->id,
            'pergunta' => $request->pergunta,
            'resposta' => $request->resposta,
            'ordem' => $request->ordem,
        ];
        $perguntas_frequentes->value = json_encode(array_map(function($item) use ($data){
            if($item->id == $data['id']){
                return $data;
            }
            return $item;
        },json_decode($perguntas_frequentes->value)));
        $perguntas_frequentes->save();

        return response()->json(json_decode($perguntas_frequentes->value));

    }

    public function destroyPerguntaFrequente(Request $request, $id){
        $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
        $perguntas_frequentes->value = json_encode(array_filter(json_decode($perguntas_frequentes->value),function($item) use ($id){
            return $item->id !=$id;
        }));
        $perguntas_frequentes->save();

        return response()->json(json_decode($perguntas_frequentes->value));
    }


}
