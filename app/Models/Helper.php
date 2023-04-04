<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Helper
{
    use HasFactory;

    //Cria um novo pedido atribuindo uma rifa aleatória que esteja em andamento e com cotas disponíveis
    public static function criarPedido()
    {
       try{
           //A rifa é escolhida aleatoriamente entre as que possuem cotas
              $rifa = Rifa::where('status', 0)->whereHas('cotas', function($query){
                $query->where('status', 'DISPONIVEL');
              })->first();
           $email = 'teste' . rand(1, 100) . '@teste.com';
           $telefone = '(24)99873-4138';
           $nome = 'Teste';
           Pedido::create([
               'rifa_id' => $rifa->id,
               'nome_cliente' => $nome,
               'email_cliente' => $email,
               'telefone_cliente' => $telefone,
               'status' => 0,
               'valor_da_compra' => $rifa->valor_por_numero,
           ]);

           $pedido = Pedido::where('telefone_cliente', $telefone)->first();
           $cota = Cota::where('rifa_id', $rifa->id)->where('status', 0)->first();
           $cota->update([
               'pedido_id' => $pedido->id,
               'status' => 'COMPRADO',
           ]);
       }catch(\Exception $e){
           return ($e->getMessage());
       }

    }
}
