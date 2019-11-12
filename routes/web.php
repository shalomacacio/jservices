<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\RouteGroup;

Route::get('/', function () {return view('welcome'); });

Route::get('/login', 'DashboardController@login')->name('login');
Route::get('/logout', 'DashboardController@logout')->name('logout');
Route::get('/register', 'DashboardController@register')->name('register');
Route::post('/auth', 'DashboardController@auth')->name('auth');

Route::post('/user', 'UsersController@store')->name('user.store');

Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('solicitacoes', 'SolicitacaosController@solicitacoes')->name('solicitacoes');
    Route::get('solicitacao/{id}/encaminhar', 'SolicitacaosController@encaminhar')->name('solicitacao.encaminhar');
    Route::post('solicitacao/atribuir', 'SolicitacaosController@atribuir')->name('solicitacao.atribuir');
    Route::resource('solicitacao', 'SolicitacaosController');
    Route::resource('servico', 'ServicosController');
    Route::resource('tecnico', 'TecnicosController');
});



