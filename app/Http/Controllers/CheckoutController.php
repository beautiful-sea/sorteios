<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Cota;
use App\Models\Paggue;
use App\Models\Pedido;
use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

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
        try{
            DB::beginTransaction();
            $data = $request->all();
            $rifa = Rifa::find($data['rifa_id']);

            $data['cliente'] = json_decode($data['cliente']);
            if(isset($data['selectedCotas'])){
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
                    //Autaliza o status no cache
                    Rifa::atualizarStatusDaCotaNoCache($cota->rifa_id, $cota->numero, 'RESERVADO',$pedido->id);
                });

            }else{
                foreach ($data['selectedCotas'] as $cot) {
                    $cota = $rifa->cotas()->where('numero', $cot->numero)->first();
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
                    //Autaliza o status no cache
                    Rifa::atualizarStatusDaCotaNoCache($cota->rifa_id, $cota->numero, 'RESERVADO',$pedido->id);
                }
            }
            $metodo_pagamento = Configuration:: where('key', 'metodo_pagamento')->first();
            if($metodo_pagamento->value == 'PAGGUE'){
                $dados_pagamento = $this->gerarPagamentoPaggue ($pedido, $amount);
                $pedido->metodo_pagamento = 'PAGGUE';
            } else {
                $dados_pagamento = $this->gerarPagamentoMercadoPago ($pedido, $amount);
                $pedido->metodo_pagamento = 'MERCADO_PAGO';
            }
            $pedido->hash_payment = $dados_pagamento['hash'];
            $pedido->qrcode = $dados_pagamento['qrcode'];
            $pedido->chave_pix = $dados_pagamento['chave_pix'];


            $pedido->save();

            $response['pedido_id'] = $pedido->id;
            $response['qrcode'] = $dados_pagamento['qrcode'];
            $response['chave_pix'] = $dados_pagamento['chave_pix'];
            $response['hash'] = $dados_pagamento['hash'];
            $response['metodo_pagamento'] = $pedido->metodo_pagamento;

            DB::commit();
            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage(),'trace'  =>  $e->getTrace()], 400);
        }

    }

    public function paggueWebhook(Request $request){
        $data = $request->all();

        $pagamento = Pedido::where('hash_payment', $data['hash'])->first();
        if($pagamento && ($data['status'] == 'paid' || $data['status'] == 1)){
            $pagamento->status = 'PAGO';
            $pagamento->save();
        }

        return response()->json(['success' => true]);
    }

    public function mercadoPagoWebhook(Request $request){
        $data = $request->all();
        //LOG info
        Log::info(json_encode($data));
        $pagamento = Pedido::where('hash_payment', $data['data']['id'])->first();
        if($pagamento && ($data['type'] == 'payment')){
            //Inicializa o SDK do Mercado Pago
            \MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
            $payment = \MercadoPago\Payment::find_by_id($_POST["data"]["id"]);
            if($payment->status == 'approved'){
                $pagamento->status = 'PAGO';
                $pagamento->save();
            }
        }

        return response()->json(['success' => true]);
    }

    public function verify(Request $request, $pedido_id){
        try{
            $pedido = Pedido::find($pedido_id);

            if($pedido->status != 'PAGO'){
                //Se o pagamento for feito pelo paggue, verifica se o pagamento foi feito
                if($pedido->metodo_pagamento === 'PAGGUE'){
//                $paggue = new Paggue();
//                $response = $paggue->getBillingOrders($pedido->hash_payment);
//                $response = json_decode($response, true);
//                if (isset($response['error'])) {
//                    throw new \Exception($response['error']);
//                }
//                if($response['status'] == 'paid'){
//                    $pedido->status = 'PAGO';
//                    $pedido->save();
//                }
                } else {
                    $payment_id = $pedido->hash_payment;
                    //Inicializa o SDK do Mercado Pago
                    \MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
                    $pagamento = \MercadoPago\Payment::find_by_id($payment_id);
                    if($pagamento->status == 'approved'){
                        $pedido->status = 'PAGO';
                        $pedido->save();
                    }
                }
            }

            //Se o pedido estiver pago, altera o status das cotas para PAGO
            if($pedido->status == 'PAGO'){
                $cotas = Cota::where('pedido_id', $pedido->id)->get();
                $cotas->each(function($cota){
                    $cota->status = 'PAGO';
                    $cota->save();
                });
                //Altera o status da cota no cache para PAGO
//                Rifa::atualizarStatusDaCotaNoCache($pedido->rifa_id, $cotas, 'PAGO');
            }

            return response()->json($pedido);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'trace'=> $e->getTrace()], 400);
        }
    }

    /**
     * Gera o pagamento no paggue e retorna o qrcode com os dados do pagamento
     * @param Request $request
     * @return array
     */
    public function gerarPagamentoPaggue($pedido, $amount){
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
        return $response;
    }

    /**
     * Gera o pagamento no mercado pago e retorna o qrcode com os dados do pagamento
     * @return array
     */
    public function gerarPagamentoMercadoPago($pedido, $amount){
        $access_token = env('MERCADO_PAGO_ACCESS_TOKEN');
        SDK::setAccessToken($access_token);

        $payment = new Payment();
        $payment->transaction_amount = $amount/100;
        $payment->description = 'Produto';
        $payment->external_reference = $pedido->id;
        $payment->payment_method_id = 'pix';

        $payer = new Payer();
        $payer->email = 'test@example.com';
        $payment->payer = $payer;

        $payment->save();

        //verifica se a pasta qr_code existe, se não, cria
        if(!file_exists(storage_path('app/public/qr_code'))){
            mkdir(storage_path('app/public/qr_code'));
        }

        //Cria a imagem do qrcode usando o base64 retornado pelo mercado pago
        $qr_code = base64_decode($payment->point_of_interaction->transaction_data->qr_code_base64);
        $file = storage_path('app/public/qr_code/'.$pedido->id.'.png');
        file_put_contents($file, $qr_code);


        return [
            'hash' => $payment->id,
            'chave_pix' => $payment->point_of_interaction->transaction_data->qr_code,
            'qrcode' => $payment->point_of_interaction->transaction_data->qr_code_base64,
        ];
    }
}
