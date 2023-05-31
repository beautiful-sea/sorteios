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
    public function index(Request $request){
        $pedidos = Pedido::query();
        if($request->has('status')){
            $pedidos->where('status',$request->status);
        }
        if($request->has('rifa_id')){
            $pedidos->where('rifa_id',$request->rifa_id);
        }
        if($request->has('search')){
            $pedidos->where(function($q) use($request){
                $q->where('nome_cliente','like','%'.$request->search.'%');
                $q->orWhere('telefone_cliente','like','%'.$request->search.'%');
            });
        }
        if($request->has('id')){
            $pedidos->where('id',$request->id);
        }
        if($request->has('numero_sorteado')){
            $pedidos->whereHas('cotas',function($query) use ($request){
                $query->where('numero',$request->numero_sorteado);
            });
        }
        //Mais recentes primeiro
        $pedidos->orderBy('created_at','desc');
        $pedidos = $pedidos->paginate($request->perPage??10);
        //Formata os números das cota do pedido de acordo com o tamanho de cotas total da rifa
        $total_cotas_rifa = Cota::where('rifa_id',$request->rifa_id)->count();
        foreach($pedidos as $pedido){
            foreach($pedido->cotas as $cota){
                $cota->numero_formatado = str_pad($cota->numero, strlen($total_cotas_rifa), '0', STR_PAD_LEFT);
            }
        }
        return response()->json($pedidos);
    }
    public function byWhatsapp(Request $request)
    {
        $data = $request->all();
        $data['whatsapp'] = str_replace(['(', ')', '-', ' '], '', $data['whatsapp']);
        $pedidos = Pedido::where('telefone_cliente', $data['whatsapp'])->get();
        return response()->json($pedidos);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->all();
        $pedido->update($data);
        return response()->json($pedido);
    }

    public function deletarTodosPendentes(){
        $pedidos = Pedido::where('status','PENDENTE')->get();
        foreach($pedidos as $pedido){
            $pedido->delete();
        }
        return response()->json(['message'=>'Pedidos deletados com sucesso']);
    }

    //Se o pedido tiver status PENDENTE, ele é deletado
    public function destroy(Pedido $pedido)
    {
        if($pedido->status == 'PENDENTE'){
            $pedido->delete();
            return response()->json(['message'=>'Pedido deletado com sucesso']);
        }else{
            return response()->json(['message'=>'Pedido não pode ser deletado']);
        }
    }
}
