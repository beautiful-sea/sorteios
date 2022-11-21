<?php

namespace App\Http\Controllers;

use App\Models\Cota;
use App\Models\MercadoPago;
use App\Models\Pedido;
use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function novo(Request $request)
    {
        $data = $request->all();
        $data['cotas'] = collect(json_decode($data['cotas'], true));
        DB::beginTransaction();
        $rifa = Rifa::find($data['rifa_id']);
        $total = count($data['cotas']) * $rifa->valor_por_numero;
        $pedido = Pedido::create([
            'nome_cliente' => 'TEsate lindomar',
            'email_cliente' => 'lindomar@teste.com',
            'telefone_cliente' => '24998734138',
            'status' => 'PENDENTE',
            'valor_da_compra' => $total,
            'rifa_id' => $rifa->id
        ]);
        $cotas = Cota::whereIn('id', $data['cotas']->pluck('id')->values())->update([
            'pedido_id' => $pedido->id,
            'status' => 'RESERVADO'
        ]);
        $data;

        $mp = new MercadoPago();
        $preference = $mp->preference;
        // Cria um item na preferência
        $item = new \MercadoPago\Item();
        $item->title = $rifa->titulo;
        $item->quantity = count($data['cotas']);
        $item->unit_price = $rifa->valor_por_numero;

        $preference->items = [$item];
        $preference->save();

        return response()->json($preference->id);
        DB::commit();
    }
}
