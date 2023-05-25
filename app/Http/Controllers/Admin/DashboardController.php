<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Retorna os ganhos mensais agrupados pelo mes do ano atual
    public function ganhosMensais(Request $request)
    {
        $pedidos = \App\Models\Pedido::query();
        $pedidos->selectRaw('sum(valor_da_compra) as total, MONTH(created_at) as mes');
        $pedidos->where('status','PAGO');
        $pedidos->whereYear('created_at',date('Y'));
        $pedidos->groupBy('mes');
        $pedidos->orderBy('mes','asc');
        $pedidos = $pedidos->get();
        //Os meses são convertidos de numero para nome
        $meses = [
            'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho',
            'Agosto','Setembro','Outubro','Novembro','Dezembro'
        ];
        foreach($pedidos as $pedido){
            $pedido->mes = $meses[$pedido->mes-1];
            //Converte o valor para real
//            $pedido->total = 'R$ '.number_format($pedido->total, 2, ',', '.');
        }
        return response()->json($pedidos);
    }

    //Retorna a quantidade de cotas total em cada rifa e a quantidade de cotas vendidas(status = RESERVADO)
    public function porcentagemVendasPorRifa(){
        $rifas = \App\Models\Rifa::query();
        $rifas->selectRaw('rifas.titulo, count(cotas.id) as total_cotas, sum(if(cotas.status = "RESERVADO",1,0)) as total_cotas_vendidas');
        $rifas->leftJoin('cotas','cotas.rifa_id','=','rifas.id');
        $rifas->groupBy('rifas.id');
        $rifas->orderBy('rifas.id','asc');
        $rifas = $rifas->get();
        foreach($rifas as $rifa){
            $rifa->porcentagem_vendas = round(($rifa->total_cotas_vendidas/$rifa->total_cotas)*100,2);
        }
        return response()->json($rifas);
    }


    public function estatisticas(){
        $data = [];
        $data['usuarios_cadastrados'] = Pedido::groupBy('telefone_cliente')->count();
        $data['pedidos_pendentes'] = Pedido:: where('status', 'PENDENTE')->count();
        $data['pedidos_pagos'] = Pedido:: where('status', 'PAGO')->count();
        $data['total_pedidos'] = Pedido::count();
        return response()->json($data);
    }

}
