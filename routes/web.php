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

    Route::get('solicitacoes', 'SolicitacaosController@solicitacoes')->name('solicitacoes');
    Route::get('solicitacao/{id}/encaminhar', 'SolicitacaosController@encaminhar')->name('solicitacao.encaminhar')->middleware('needsRole:admin');
    Route::get('solicitacao/ajaxCliente', 'SolicitacaosController@ajaxCliente');
    Route::get('solicitacao/ajaxServicos', 'SolicitacaosController@ajaxServicos');
    Route::get('solicitacao/ajaxValor', 'SolicitacaosController@ajaxValor');
    Route::post('solicitacao/atribuir', 'SolicitacaosController@atribuir')->name('solicitacao.atribuir')->middleware('needsRole:admin|supervisor, true');
    Route::get('solicitacao/{id}/concluir', 'SolicitacaosController@concluir')->name('solicitacao.concluir')->middleware('needsRole:admin|supervisor, true');

    Route::get('users/groups', 'UsersController@groups')->name('user.groups')->middleware('needsRole:admin');
    Route::post('users/groupStore', 'UsersController@groupStore')->name('user.groups.store')->middleware('needsRole:admin');
    Route::resource('users', 'UsersController');
    Route::resource('solicitacao', 'SolicitacaosController');
    Route::resource('tecnologia', 'TecnologiasController');
    Route::resource('servicos', 'ServicosController');
    Route::resource('tecnico', 'TecnicosController');
    Route::resource('clientes', 'ClientesController');
    Route::get('comissaos/comissoes', 'ComissaosController@comissoes')->name('comissao.comissoes')->middleware('needsRole:admin|auditor, true');;
    Route::put('comissaos/{id}/autorizar', 'ComissaosController@autorizar')->name('comissao.autorizar')->middleware('needsRole:admin|auditor, true');;
    Route::resource('comissaos', 'ComissaosController');
    Route::resource('escalas', 'EscalasController');

    //parametros
    Route::resource('tipoUsuario', 'TipoUsuariosController');
    Route::resource('tipoAquisicao', 'TipoAquisicaosController');
    Route::resource('tipoMidias', 'TipoMidiasController');
    Route::resource('tipoPagamento', 'TipoPagamentosController');
    Route::resource('statusSolicitacao', 'StatusSolicitacaosController');
    Route::resource('categoriaServicos', 'CategoriaServicosController');
    Route::resource('comissaoServicos', 'ComissaoServicosController');

  //Report
    Route::get('reports/comissoes', 'ReportsController@comissoes')->name('reports.comissoes');
    Route::get('reports/users', 'ReportsController@users')->name('reports.users');
    Route::get('reports/formFunc', 'ReportsController@formFunc')->name('reports.formFunc');
    Route::get('reports/formCom', 'ReportsController@formCom')->name('reports.formCom');

});



