<?php

use App\Entities\Solicitacao;

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

    Route::get('solicitacoes/pesquisar', 'SolicitacaosController@pesquisar')->name('solicitacoes.pesquisar');
    Route::get('solicitacoes/resultPesquisa', 'SolicitacaosController@resultPesquisa')->name('solicitacoes.resultPesquisa');
    Route::get('solicitacoes', 'SolicitacaosController@solicitacoes')->name('solicitacoes');
    Route::get('solicitacoes/fila', 'SolicitacaosController@fila')->name('solicitacoes.fila');
    Route::get('solicitacao/{id}/encaminhar', 'SolicitacaosController@encaminhar')->name('solicitacao.encaminhar')->middleware('needsRole:admin|controlador, true');
    Route::get('solicitacao/{id}/reagendar', 'SolicitacaosController@reagendar')->name('solicitacao.reagendar')->middleware('needsRole:admin|controlador, true');

    Route::get('solicitacao/ajaxCliente', 'SolicitacaosController@ajaxCliente');
    Route::get('solicitacao/ajaxServicos', 'SolicitacaosController@ajaxServicos');
    Route::get('solicitacao/ajaxValor', 'SolicitacaosController@ajaxValor');
    Route::get('solicitacao/ajaxDiferenca', 'SolicitacaosController@ajaxDiferenca');
    Route::get('solicitacao/{id}/integracao', 'SolicitacaosController@integracao')->name('solicitacao.integracao')->middleware('needsRole:admin|supervisor, true');
    Route::put('solicitacao/integrar', 'SolicitacaosController@integrar')->name('solicitacao.integrar')->middleware('needsRole:admin|supervisor, true');
    Route::post('solicitacao/atribuir', 'SolicitacaosController@atribuir')->name('solicitacao.atribuir')->middleware('needsRole:admin|controlador, true');
    Route::post('solicitacao/reatribuir', 'SolicitacaosController@reatribuir')->name('solicitacao.reatribuir')->middleware('needsRole:admin|controlador, true');
    Route::get('solicitacao/{id}/concluir', 'SolicitacaosController@concluir')->name('solicitacao.concluir')->middleware('needsRole:admin|controlador, true');

    Route::get('users/groups', 'UsersController@groups')->name('user.groups')->middleware('needsRole:admin');
    Route::post('users/groupStore', 'UsersController@groupStore')->name('user.groups.store')->middleware('needsRole:admin');
    Route::resource('users', 'UsersController');
    Route::resource('solicitacao', 'SolicitacaosController');
    Route::resource('tecnologia', 'TecnologiasController');
    // Route::resource('servicos', 'ServicosController');
    Route::resource('tecnico', 'TecnicosController');
    Route::get('autocomplete', 'ClientesController@autocomplete')->name('autocomplete');
    Route::resource('clientes', 'ClientesController');
    Route::get('comissaos/autorizarComissoes', 'ComissaosController@autorizarComissoes')->name('comissao.autorizarComissoes')->middleware('needsRole:admin|auditor|atendimento, true');
    Route::get('comissaos/minhasComissoes', 'ComissaosController@minhasComissoes')->name('comissao.minhasComissoes');
    Route::put('comissaos/{id}/autorizar', 'ComissaosController@autorizar')->name('comissao.autorizar')->middleware('needsRole:admin|auditor, true');
    Route::put('comissaos/{id}/nAutorizar', 'ComissaosController@nAutorizar')->name('comissao.nAutorizar')->middleware('needsRole:admin|auditor, true');;
    Route::get('comissaos/pesquisarminhascomissoes', 'ComissaosController@pesquisarMinhasComissoes')->name('comissao.pesquisarMinhasComissoes')->middleware('needsRole:admin|atendimento|vendedor|suporte, true');
    Route::get('comissaos/search', 'ComissaosController@search')->name('comissao.search')->middleware('needsRole:admin|atendimento|suporte|vendedor, true');
    Route::resource('comissaos', 'ComissaosController');
    Route::get('escalas/agenda', 'EscalasController@agenda')->name('escalas.agenda');
    Route::get('escalas/agenda2', 'EscalasController@agenda2')->name('escalas.agenda2');
    Route::get('escalas/escala', 'EscalasController@escala')->name('escalas.escala');
    Route::get('escalas/search', 'EscalasController@search')->name('escalas.search');
    Route::get('escalas/search2', 'EscalasController@search2')->name('escalas.search2');
    Route::resource('escalas', 'EscalasController');
    //parametros
    Route::resource('planos', 'PlanosController');
    Route::resource('roles', 'RolesController');
    Route::resource('origem', 'OrigemVendasController');
    Route::resource('tipoUsuario', 'TipoUsuariosController');
    Route::resource('motivoCancelamento', 'MotivoCancelamentosController');
    Route::resource('tipoAquisicao', 'TipoAquisicaosController');
    Route::resource('tipoMidias', 'TipoMidiasController');
    Route::resource('tipoPagamento', 'TipoPagamentosController');
    Route::resource('statusSolicitacao', 'StatusSolicitacaosController');
    Route::resource('categoriaServicos', 'CategoriaServicosController');
    Route::resource('comissaoServicos', 'ComissaoServicosController');
  //Report
    Route::get('reports/comissaoForm', 'ReportsController@comissaoForm')->name('reports.comissaos.form');
    Route::get('reports/producaoDiaria', 'ReportsController@producaoDiaria')->name('reports.producaoDiaria');
    Route::get('reports/producaoDiariaForm', 'ReportsController@producaoDiariaForm')->name('reports.producaoDiariaForm');
    Route::get('reports/comissoes', 'ReportsController@comissoes')->name('reports.comissoes');
    Route::get('reports/servicosForm', 'ReportsController@servicosForm')->name('reports.servicos.form');
    Route::get('reports/servicos', 'ReportsController@servicos')->name('reports.servicos');
    Route::get('reports/midias', 'ReportsController@midias')->name('reports.midias');

    Route::resource('mkPessoas', 'MkPessoasController');
    Route::resource('mkBairros', 'MkBairrosController');
    Route::resource('mkAtendimentos', 'MkAtendimentosController');

    Route::post('/agenda2', function(){
      $data = Solicitacao::all();

      $response = [
        'current'  => 1,
        'rowCount' => 10,
        'rows'     => $data
    ];
      return response()->json($response);
    });
});
