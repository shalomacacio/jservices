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

  Route::get('/', function () {return redirect()->route('login'); });
  Route::get('/login', 'DashboardController@login')->name('login');
  Route::post('/auth', 'DashboardController@auth')->name('auth');


Route::group(['middleware'=>['auth']], function(){

    Route::get('/logout', 'DashboardController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    // Route::get('/register', 'DashboardController@register')->name('register');
    Route::resource('user', 'UsersController');

    Route::get('solicitacoes', 'SolicitacaosController@solicitacoes')->name('solicitacoes');
    Route::get('solicitacao/{id}/encaminhar', 'SolicitacaosController@encaminhar')->name('solicitacao.encaminhar');
    Route::get('solicitacao/ajaxServicos', 'SolicitacaosController@ajaxServicos');
    Route::get('solicitacao/ajaxValor', 'SolicitacaosController@ajaxValor');
    Route::post('solicitacao/atribuir', 'SolicitacaosController@atribuir')->name('solicitacao.atribuir');
    Route::resource('solicitacao', 'SolicitacaosController');
    Route::resource('categoriaServicos', 'CategoriaServicosController');
    Route::resource('servico', 'ServicosController');
    Route::resource('tecnico', 'TecnicosController');
});



