<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request){
        if($request->expectsJson()){
            $clientes = \App\Models\Pedido::query();
            if($request->has('search')){
                $clientes->where(function($q) use($request){
                    $q->where('nome_cliente','like','%'.$request->search.'%');
                    $q->orWhere('telefone_cliente','like','%'.$request->search.'%');
                });
            }
            if($request->has('rifa_id')){
                $clientes->whereHas('rifa',function($q) use($request){
                    $q->where('id',$request->rifa_id);
                });
            }
            //Agrupa por telefone_cliente, mantendo o mais antigo
            $clientes->groupBy('telefone_cliente','nome_cliente','created_at');
            //Seleciona apenas os campos necessários
            $clientes->select('telefone_cliente','nome_cliente','created_at');
            //Ordena pelo mais antigo
            $clientes->orderBy('created_at','asc');
            return response()->json($clientes->paginate($request->perPage??10));
        }
        return view('pages.admin.clientes.index');
    }

    //Gera o CSV de clientes com NOME,TELEFOME,DATA DE CADASTRO
    public function geraCSV(Request $request){
        $clientes = \App\Models\Pedido::query();
        if($request->has('search')){
            $clientes->where(function($q) use($request){
                $q->where('nome_cliente','like','%'.$request->search.'%');
                $q->orWhere('telefone_cliente','like','%'.$request->search.'%');
            });
        }
        if($request->has('rifa_id')){
            $clientes->whereHas('rifa',function($q) use($request){
                $q->where('id',$request->rifa_id);
            });
        }
        //Agrupa por telefone_cliente, mantendo o mais antigo
        $clientes->groupBy('telefone_cliente','nome_cliente','created_at');
        //Seleciona apenas os campos necessários
        $clientes->select('telefone_cliente','nome_cliente','created_at');
        //Ordena pelo mais antigo
        $clientes->orderBy('created_at','asc');
        $clientes = $clientes->get();
        //Gera o csv sem biblioteca
        $csv = "NOME,TELEFONE,DATA DE CADASTRO\n";
        foreach($clientes as $cliente){
            $csv .= $cliente->nome_cliente.','.$cliente->telefone_cliente.','.$cliente->created_at->format('d/m/Y')."\n";
        }
        return response($csv,200,[
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="clientes.csv"'
        ]);
    }

    public function pedidosByTelefone($telefone_cliente){
        $pedidos = \App\Models\Pedido::where('telefone_cliente',$telefone_cliente)->get();
        return response()->json($pedidos);
    }

    public function update(Request $request, $telefone_cliente){
        $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'telefone_cliente' => 'required|string|max:255',
        ],[
            'nome_cliente.required' => 'O nome do cliente é obrigatório',
            'telefone_cliente.required' => 'O telefone do cliente é obrigatório',
        ]);
        $pedidos = \App\Models\Pedido::where('telefone_cliente',$telefone_cliente)->get();
        foreach($pedidos as $pedido){
            $pedido->update($request->all());
        }
        return response()->json($pedidos);
    }
}
