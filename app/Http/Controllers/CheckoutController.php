<?php

namespace App\Http\Controllers;

use App\Models\Paggue;
use App\Models\Pedido;
use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function verificarCadastroCliente(Request $request){
        $data = $request->all();
        $rifa = Rifa::find($data['rifa_id']);
        $data['cliente'] = json_decode($data['cliente']);
        //Verifica se o cliente ja possui um pedido para essa rifa
        $data['cliente']->whatsapp = str_replace(['(', ')', '-', ' '], '', $data['cliente']->whatsapp);
        $pedido = Pedido::where('rifa_id', $rifa->id)->where('telefone_cliente', $data['cliente']->whatsapp)->first();
        if($pedido){
            $response['nome_cliente'] = $pedido->nome_cliente;
            //Formato o telefone para o formato (00)00000-0000
            $response['telefone_cliente'] = '(' . substr($pedido->telefone_cliente, 0, 2) . ')' . substr($pedido->telefone_cliente, 2, 5) . '-' . substr($pedido->telefone_cliente, 7, 4);
            return response()->json($response,201);
        }
        return response()->json(['success' => true],200);
    }

    public function cadastrar(Request $request){
        DB::beginTransaction();
        $data = $request->all();
        $rifa = Rifa::find($data['rifa_id']);

        $data['cliente'] = json_decode($data['cliente']);
        if($data['selectedCotas']){
            $data['selectedCotas'] = json_decode($data['selectedCotas']);
        }
        $pedido = new Pedido();
        $pedido->nome_cliente =  $data['cliente']->nome;
        $pedido->telefone_cliente =  $data['cliente']->whatsapp;
        $pedido->rifa_id =  $rifa->id;
        $valor_compra = $data['qtdCotas'] * $rifa->valor_por_numero;
        $pedido->valor_da_compra = $valor_compra;
        $amount = $valor_compra * 100;
        $pedido->save();
        if($rifa->is_compra_automatica){
            $cotas = $rifa->cotas()->where('status', 'DISPONIVEL')->where('pedido_id',null)->limit($data['qtdCotas'])->get();
            $cotas->each(function($cota) use ($pedido){
                $cota->pedido_id = $pedido->id;
                $cota->status = 'RESERVADO';
                $cota->save();
            });
        }else{
            foreach ($data['selectedCotas'] as $cot) {
                $cota = $rifa->cotas()->where('id', $cot->id)->first();
                if(!$cota){
                    DB::rollBack();
                    return response()->json(['message' => 'A cota '.$cot->numero.' não existe. Por favor, escolha outra para prosseguir.'], 400);
                }
                if($cota->status != 'DISPONIVEL' || $cota->pedido_id != null){
                    DB::rollBack();
                    return response()->json(['message' => 'A cota '.$cota->numero.' já foi reservada. Por favor, escolha outra para prosseguir.'], 400);
                }
                //Atribui o pedido a cota
                $cota->pedido_id = $pedido->id;
                $cota->status = 'RESERVADO';
                $cota->save();
            }
        }

        $paggue = new Paggue();
        $dados_pagamento = $paggue->billingOrder($pedido->nome_cliente, $amount, $pedido->id, "Pedido de compra de cota de rifa");
        $dados_pagamento = json_decode($dados_pagamento, true);
        if (isset($dados_pagamento['error'])) {
            throw new \Exception($dados_pagamento['error']);
        }

        $qr_code = $paggue->gerarQrCodePix($dados_pagamento['payment'], $pedido->id);
        //Cria o qr code do pagamento
        $response['qrcode'] = $qr_code;
        $response['chave_pix'] = $dados_pagamento['payment'];
        $response['hash'] = $dados_pagamento['hash'];
        $pedido->hash_payment = $dados_pagamento['hash'];
        $pedido->qrcode = $qr_code;
        $pedido->chave_pix = $dados_pagamento['payment'];
        $pedido->save();

        $response['pedido_id'] = $pedido->id;

        DB::commit();
        return response()->json($response);

    }

    public function paggueWebhook(Request $request){
        $data = $request->all();
        //LOG info
        Log::info(json_encode($data));
        $pagamento = Pedido::where('id', $data['external_id'])->first();
        if($pagamento && ($data['status'] == 'paid' || $data['status'] == 1)){
            $pagamento->status = 'PAGO';
            $pagamento->save();
        }

        return response()->json(['success' => true]);
    }

    public function verify(Request $request, $pedido_id){
        $pedido = Pedido::find($pedido_id);
        return response()->json($pedido);
    }
}
