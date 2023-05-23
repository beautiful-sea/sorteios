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
    Route::get('/sorteios', 'App\Http\Controllers\RifaController@index')->name('sorteios.index');
    Route::get('/', 'App\Http\Controllers\RifaController@index')->name('sorteios.index');
    Route::get('/meus-numeros', 'App\Http\Controllers\RifaController@meusNumeros');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
});


// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth' ]], function () {

    Route::resource('rifas', \App\Http\Controllers\RifaController::class );
    Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');
});

