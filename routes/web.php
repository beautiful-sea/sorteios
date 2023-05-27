<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Auth Routes manual
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');


// Homepage Route
Route::group([], function () {
    Route::get('/sorteios/{rifa}', 'App\Http\Controllers\RifaController@show')->name('sorteios.show');
    Route::get('/sorteios', 'App\Http\Controllers\RifaController@index');
    Route::get('/', 'App\Http\Controllers\RifaController@index')->name('sorteios.index');
    Route::get('/meus-numeros', 'App\Http\Controllers\RifaController@meusNumeros');
    Route::get('/ganhadores', 'App\Http\Controllers\RifaController@ganhadores')->name('ganhadores');
    Route::get('/termos-de-uso', 'App\Http\Controllers\TermosController@index')->name('termos');

});


// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth' ]], function () {

    Route::resource('clientes', \App\Http\Controllers\ClienteController::class );
    Route::resource('rifas', \App\Http\Controllers\RifaController::class );
    Route::resource('pedidos', \App\Http\Controllers\Admin\PedidoController::class );
    Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('perfil', 'App\Http\Controllers\PerfilController@index')->name('profile');
    Route::get('configuracoes', 'App\Http\Controllers\ConfiguracoesController@index')->name('configuracoes.index');

    Route::get('usuarios', 'App\Http\Controllers\UsuarioController@index')->name('usuarios.index');
});

//Notificação paggue
Route::post('paggue/notificacao', 'App\Http\Controllers\Checkout@paggueWebhook')->name('paggue.notificacao');

//Notificação Mercado Pago
Route::post('mercadopago/notificacao', 'App\Http\Controllers\Checkout@mercadoPagoWebhook')->name('mercadopago.notificacao');

