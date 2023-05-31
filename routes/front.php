<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([],function () {
    Route::get('cotas/total-com-status-pago', 'CotaController@getTotalComStatusPago');
    Route::get('cotas/total-com-status-reservado', 'CotaController@getTotalComStatusReservado');
    Route::get('cotas/total-com-status-disponivel', 'CotaController@getTotalComStatusDisponivel');
    Route::get('cotas/{rifa}', 'CotaController@all');
    Route::get('rifas', 'RifaController@index');

    Route::get('/sorteios', 'RifaController@index');
    Route::post('/checkout/cadastrar', 'CheckoutController@cadastrar');
    Route::get('/checkout/verify/{pedido_id}', 'CheckoutController@verify');
    Route::get('/pedidos/byWhatsapp', 'PedidoController@byWhatsapp');
    Route::get('/checkout/verificarCadastroCliente', 'CheckoutController@verificarCadastroCliente');

});

Route::group(['middleware' => 'admin'], function () {
    Route::delete('pedidos/deletar-todos-pendentes' , 'PedidoController@deletarTodosPendentes');
    Route::delete('pedidos/deletar-todos-pendentes-vencidos' , 'PedidoController@deletarTodosPendentesVencidos');
    Route::put('pedidos/{pedido}', 'PedidoController@update');
    Route::delete('pedidos/{pedido}', 'PedidoController@destroy');
    Route::get('pedidos', 'PedidoController@index');

    Route::get('perfil', 'PerfilController@index');
    Route::put('perfil', 'PerfilController@update');

    Route::get('clientes', 'ClienteController@index');
    Route::put('clientes/{telefone_cliente}', 'ClienteController@update');
    Route::get('clientes/{telefone_cliente}/pedidos',  'ClienteController@pedidosByTelefone');
    Route::get('clientes/geraCSV', 'ClienteController@geraCSV');

    //Grupo Dashboard
    Route::group(['prefix'=>'dashboard'],function() {
        Route::get('ganhos-mensais', 'Admin\DashboardController@ganhosMensais');
        Route::get('porcentagem-vendas-por-rifa', 'Admin\DashboardController@porcentagemVendasPorRifa');
        Route::get('estatisticas', 'Admin\DashboardController@estatisticas');
    });

    Route::get('configuracoes/termos-de-uso', 'ConfiguracoesController@getTermos');
    Route::post('configuracoes/termos-de-uso', 'ConfiguracoesController@updateTermos');

    Route::get('configuracoes/metodo-pagamento', 'ConfiguracoesController@getMetodoPagamento');
    Route::post('configuracoes/metodo-pagamento', 'ConfiguracoesController@updateMetodoPagamento');

    Route::get('configuracoes/perguntas', 'ConfiguracoesController@getPerguntasFrequentes');
    Route::post('configuracoes/perguntas', 'ConfiguracoesController@storePerguntasFrequentes');
    Route::put('configuracoes/perguntas/{pergunta}', 'ConfiguracoesController@updatePerguntaFrequente');
    Route::delete('configuracoes/perguntas/{pergunta}', 'ConfiguracoesController@destroyPerguntaFrequente');

    Route::get('usuarios', 'UsuarioController@index');
    Route::post('usuarios', 'UsuarioController@store');
    Route::delete('usuarios/{usuario}', 'UsuarioController@destroy');
    Route::put('usuarios/{usuario}', 'UsuarioController@update');



});


