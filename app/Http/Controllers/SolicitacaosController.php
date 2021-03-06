<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SolicitacaoCreateRequest;
use App\Http\Requests\SolicitacaoUpdateRequest;
use App\Repositories\SolicitacaoRepository;
use App\Repositories\ComissaoRepository;
use App\Validators\SolicitacaoValidator;
use App\Validators\ComissaoServicoValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Entities\Comissao;
use App\Entities\Cliente;
use App\Entities\Escala;
use App\Entities\Plano;
use App\Entities\MkPessoa;
use App\Entities\MkAtendimento;
use Illuminate\Validation\Rule;

/**
 * Class SolicitacaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class SolicitacaosController extends Controller
{
  /**
   * @var SolicitacaoRepository
   */
  protected $repository;
  protected $comissaoRepository;

  /**
   * @var SolicitacaoValidator
   */
  protected $validator;

  /**
   * SolicitacaosController constructor.
   *
   * @param SolicitacaoRepository $repository
   * @param SolicitacaoValidator $validator
   */
  public function __construct(SolicitacaoRepository $repository, ComissaoRepository $comissaoRepository, SolicitacaoValidator $validator)
  {
    $this->repository = $repository;
    $this->validator  = $validator;
    $this->comissaoRepository =  $comissaoRepository;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    $solicitacaos = $this->repository->scopeQuery(function ($query) {
      return $query
        ->where('user_id', Auth::user()->id)
        ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->orderBy('dt_agendamento', 'desc');
    })->paginate(10);

    $users = DB::table('users as u')
    ->join('role_user as ru','u.id','=','ru.user_id')
    ->where('ru.role_id', 2)
    ->get();

    $categorias = DB::table('categoria_servicos')->whereNull('deleted_at')->distinct()->get();
    $planos = DB::table('planos')->distinct()->get();
    $tecnologias = DB::table('tecnologias')->distinct()->get();
    $tipoPagamentos = DB::table('tipo_pagamentos')->distinct()->get();
    $tipoAquisicaos = DB::table('tipo_aquisicaos')->distinct()->get();
    $tipoMidia = DB::table('tipo_midias')->distinct()->get();
    $origens = DB::table('origem_vendas')->distinct()->get();

    $comissaos = $this->comissaoRepository
              ->findWhereBetween('created_at',
              [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()],
              ['*'])->where('funcionario_id', Auth::user()->id);

    $aguardando = $comissaos->where('flg_autorizado', '=', 3)->sum('comissao_vlr');
    $nAutorizado = $comissaos->where('flg_autorizado', '=', 0)->sum('comissao_vlr');
    $autorizado = $comissaos->where('flg_autorizado', '=', 1)->sum('comissao_vlr');

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos,
      ]);
    }
    return view('solicitacaos.index', compact('solicitacaos', 'categorias', 'tecnologias', 'tipoPagamentos', 'tipoAquisicaos', 'tipoMidia', 'comissaos', 'aguardando', 'nAutorizado', 'autorizado', 'planos', 'users', 'origens'));
  }

  public function create()
  {
    $users = DB::table('users as u')
    ->join('role_user as ru','u.id','=','ru.user_id')
    ->whereIn('ru.role_id', [2,7,8])
    ->get();



    $categorias = DB::table('categoria_servicos')->whereNull('deleted_at')->distinct()->get();
    $planos = DB::table('planos')->distinct()->get();
    $tecnologias = DB::table('tecnologias')->distinct()->get();
    $tipoPagamentos = DB::table('tipo_pagamentos')->distinct()->get();
    $tipoAquisicaos = DB::table('tipo_aquisicaos')->distinct()->get();
    $tipoMidia = DB::table('tipo_midias')->distinct()->get();
    $origens = DB::table('origem_vendas')->distinct()->get();
    $motivos = DB::table('motivo_cancelamentos')->distinct()->get();

    return view('solicitacaos.create', compact('categorias', 'tecnologias', 'tipoPagamentos', 'tipoAquisicaos', 'tipoMidia','planos', 'users', 'origens', 'motivos'));
  }

  public function ajaxServicos(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    // $categoria = DB::table('categoria_servicos')->where('id', $request->categoria_servico_id)->get();
    $servicos = DB::table('servicos')
      ->where('categoria_servico_id', $request->categoria_servico_id)
      ->get();
    return response()->json([
      'servicos' => $servicos
    ]);
  }

  public function ajaxAtendimento(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $atendimento  = MkAtendimento::find($request->codatendimento);
    $cliente = $atendimento->mkPessoa;
    return response()->json([
      'atendimento' => $atendimento,
      'cliente' => $cliente
    ]);
  }

  public function ajaxQtdServDia(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $qtdEscala = DB::table('escalas')->where('dt_escala', $request->dt_agendamento )->select('total_atend')->first();
    $qtdMarcada = DB::table('solicitacaos as s')
      ->where('dt_agendamento', $request->dt_agendamento)
      ->whereNotIn('categoria_servico_id', [9] )
      ->whereNull('s.deleted_at')
      ->count();
    $dataValidation = true;
    //verifica se existe escala
    if(!$qtdEscala){
      $dataValidation = false;
      return response()->json([
        'message' => 'Não existe escala para esta data',
        'dataValidation' => $dataValidation
      ]);
    }

    if($qtdEscala->total_atend <= $qtdMarcada  ){
      $dataValidation = false;
      return response()->json([
        'message' => 'Não há vagas neste dia Máximo: '.$qtdEscala->total_atend.' atendimentos' ,
        'dataValidation' => $dataValidation,
      ]);
    }

    return response()->json([
      'message' => '200',
      'dataValidation' => $dataValidation,
      'qtdAgendada' => $qtdMarcada,
      'qtdEscala' => $qtdEscala->total_atend
    ]);
  }

  public function ajaxValor(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $plano = DB::table('planos')->where('id', $request->plano_id)->first();
    return response()->json($plano);
  }

  public function ajaxDiferenca(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $valor = Plano::find($request->plano_id);
    $valor_ant = Plano::find($request->plano_ant_id);

    $diferenca = $valor->vlr_plano - $valor_ant->vlr_plano;

    return response()->json($diferenca);
  }

  public function ajaxCliente(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    // $cliente = DB::connection('pgsql')->select('select codpessoa, nome_razaosocial from mk_pessoas where codpessoa =?', [$request->codpessoa]);

    $cliente = MkPessoa::find($request->codpessoa);
    if ($cliente == null) {
      return response()->json([
        'error'   => true,
        'message' => " Cliente não encontrado"
      ]);
    }

    return response()->json($cliente);
  }

  public function encaminhar($id)
  {
    $solicitacao = $this->repository->find($id);

    try {
      $escala = Escala::where('dt_escala', '>=', Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d 00:00:00'))
      ->where('dt_escala', '<=', Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d 23:59:59'))
      ->firstOrFail();

      $tecnicos = $escala->users;

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      $message = 'não existe escala cadastrada para a data: '. Carbon::parse($solicitacao->dt_agendamento)->format('d/m/Y') ;
      return redirect()->back()->withErrors( $message);
    }
    return view('solicitacaos.encaminhar', compact('solicitacao', 'tecnicos'));
  }

  public function pesquisar(){
    return view('solicitacaos.pesquisa');
  }

  public function resultPesquisa(Request $request){
    $start = $request->dt_inicio;
    $end = $request->dt_fim;

    $result = DB::table('solicitacaos as s')
                ->join('status_solicitacaos as ss', 's.status_solicitacao_id', '=', 'ss.id')
                ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
                ->join('users as u', 's.user_atendimento_id', '=', 'u.id')
                ->select('s.id','s.dt_agendamento','s.nome_razaosocial', 'u.name as user',
                'cs.descricao as categoria', 'ss.descricao as status', 's.deleted_at')
                ->whereNull('s.deleted_at')
                ->orderBy('dt_agendamento', 'asc');

    if($request->tipo_pesquisa == 1){
        $solicitacaos = $result
          ->where('s.dt_agendamento', '>=', Carbon::parse($start)->format('Y-m-d 00:00:00'))
          ->where('s.dt_agendamento', '<=', Carbon::parse($end)->format('Y-m-d 23:59:59'))
          ->get();
    }elseif($request->tipo_pesquisa == 2){
        $solicitacaos = $result
          ->where('s.nome_razaosocial', 'LIKE', "%".$request->nome_cliente."%")
          ->get();
    }



    return view('solicitacaos.solicitacoes', compact('solicitacaos'));
  }

  public function reagendar($id)
  {
    $solicitacao = $this->repository->find($id);

    $escala = Escala::where('dt_escala', '>=', Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d 00:00:00'))
                      ->where('dt_escala', '<=', Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d 23:59:59'))
                      ->firstOrFail();
    try {
      $tecnicos = $escala->users;
    } catch (\ModelNotFoundException $e) {
        return response()->json([
          'error'   => true,
          'message' => $e->getMessageBag()
        ]);
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }
    return view('solicitacaos.reagendar', compact('solicitacao', 'tecnicos'));
  }

  public function atribuir(Request $request)
  {

    try {

      $solicitacao = $this->repository->find($request->solicitacao_id);
      //vincula solicitação a equipe
      $solicitacao->users()->attach($request->equipe);
      //atualiza o status para em andamento
      $solicitacao->status_solicitacao_id = 2;
      $solicitacao->save();

      $response = [
        'message' => 'Solicitacao Atribuida.',
      ];
      if ($request->wantsJson()) {
        return response()->json($response);
      }
      return redirect()->route('solicitacoes.fila')->with('message', $response['message']);
    } catch (ValidatorException $e) {
      if ($request->wantsJson()) {
        return response()->json([
          'error'   => true,
          'message' => $e->getMessageBag()
        ]);
      }
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }
  }

  public function reatribuir(Request $request)
  {
    try {

      $solicitacao = $this->repository->find($request->solicitacao_id);
      // Detach all roles from the user...
      $solicitacao->users()->detach();
      // $solicitacao->save();

      //atualiza o status para em andamento
      $solicitacao->status_solicitacao_id = 6;
      $solicitacao->dt_agendamento = $request->dt_agendamento;
      $solicitacao->save();

      $response = [
        'message' => 'Solicitacao Reagendada.',
      ];
      if ($request->wantsJson()) {
        return response()->json($response);
      }
      return redirect()->route('solicitacoes.fila')->with('message', $response['message']);
    } catch (ValidatorException $e) {
      if ($request->wantsJson()) {
        return response()->json([
          'error'   => true,
          'message' => $e->getMessageBag()
        ]);
      }
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }
  }

  public function solicitacoes()
  {
    $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    // $start = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00'); // Mês atual
    $start = Carbon::parse('2020-01-01 00:00:00')->format('Y-m-d 00:00:00');
    $end = Carbon::now()->endOfMonth()->format('Y-m-d 23:59:59');

    $solicitacaos = $this->repository->scopeQuery(function ($query) use ($start, $end) {
      return $query
        ->whereDate('dt_agendamento', '>=', $start)
        ->whereDate('dt_agendamento', '<=', $end)
        // ->whereNotIn('status_solicitacao_id', ['4']) // , 4 - cancelada
        ->orderBy('dt_agendamento', 'desc');
    })->paginate(10);

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos,
      ]);
    }
    return view('solicitacaos.solicitacoes', compact('solicitacaos'));
  }

  public function fila()
  {
    $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

    $solicitacaos = $this->repository->scopeQuery(function ($query) {
      return $query
        // ->whereNotIn('categoria_servico_id', [9])
        ->whereNotIn('status_solicitacao_id', ['4']) // , 4 - cancelada
        ->whereNull('dt_conclusao')
        ->orderBy('dt_agendamento', 'desc');
    })->paginate(90);

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos->nome_razaosocial,
      ]);
    }
    return view('solicitacaos.fila', compact('solicitacaos'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  SolicitacaoCreateRequest $request
   *
   * @return \Illuminate\Http\Response
   *
   * @throws \Prettus\Validator\Exceptions\ValidatorException
   */
  public function store(SolicitacaoCreateRequest $request)
  {
    try {


      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

      $solicitacao = $this->repository->create($request->all());
      $comissao = $this->comissaoRepository->createComissao($solicitacao);

      $response = [
        'message' => 'Solicitacao created.',
        'data'    => $solicitacao->toArray(),
      ];
      if ($request->wantsJson()) {
        return response()->json($response);
      }
      return redirect()->back()->with('message', $response['message']);
    } catch (ValidatorException $e) {

      if ($request->wantsJson()) {
        return response()->json([
          'error'   => true,
          'message' => $e->getMessageBag()
        ]);
      }
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $solicitacao = $this->repository->find($id);
    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacao,
      ]);
    }
    return view('solicitacaos.show', compact('solicitacao'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $solicitacao = $this->repository->find($id);

    $users = DB::table('users as u')
    ->join('role_user as ru','u.id','=','ru.user_id')
    ->whereIn('ru.role_id', [2,7,8])
    ->get();

    $categorias = DB::table('categoria_servicos')->distinct()->get();
    $planos = DB::table('planos')->distinct()->get();
    $tecnologias = DB::table('tecnologias')->distinct()->get();
    $tipoPagamentos = DB::table('tipo_pagamentos')->distinct()->get();
    $tipoAquisicaos = DB::table('tipo_aquisicaos')->distinct()->get();
    $tipoMidia = DB::table('tipo_midias')->distinct()->get();
    $origens = DB::table('origem_vendas')->distinct()->get();
    $motivos = DB::table('motivo_cancelamentos')->distinct()->get();

    return view('solicitacaos.edit', compact('solicitacao','categorias', 'tecnologias', 'tipoPagamentos', 'tipoAquisicaos', 'tipoMidia','planos', 'users', 'origens', 'motivos'));
  }

  public function integracao($id)
  {
    $solicitacao = $this->repository->find($id);
    return view('solicitacaos.integracao', compact('solicitacao'));
  }

  public function integrar(Request $request)
  {
    // return dd($request);
    $solicitacao = $this->repository->find($request->solicitacao_id);
    $solicitacao->codpessoa = $request->codpessoa;
    $solicitacao->save();


    return redirect()->route('solicitacoes.fila');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  SolicitacaoUpdateRequest $request
   * @param  string            $id
   *
   * @return Response
   *
   * @throws \Prettus\Validator\Exceptions\ValidatorException
   */
  public function concluir($id)
  {
    try {
      $solicitacao = $this->repository->find($id);
      $solicitacao->status_solicitacao_id = 3;
      $solicitacao->dt_conclusao = Carbon::now();
      $solicitacao->save();

      $comissao = $this->comissaoRepository->createComissaoExec($solicitacao);

      $response = [
        'message' => 'Solicitacao updated.',
        'data'    => $solicitacao->toArray(),
      ];

      return redirect()->back()->with('message', $response['message']);

    } catch (ValidatorException $e) {
      // if ($request->wantsJson()) {
      //   return response()->json([
      //     'error'   => true,
      //     'message' => $e->getMessageBag()
      //   ]);
      // }
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }

  }

  public function cancelar(Request $request, $id){
    $comissao = $this->comissaoRepository->deleteComissaoGrupo($id);
    $solicitacao = $this->repository->update($request->all(), $id);

    $response = [
      'message' => 'Solicitação Cancelada'
    ];

    return redirect()->back()->with('message', $response['message']);
  }


  public function update(SolicitacaoUpdateRequest $request, $id)
  {
    try {

      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
      $solicitacao = $this->repository->update($request->all(), $id);
      $comissao = $this->comissaoRepository->updateComissao($solicitacao);


      $response = [
        'message' => 'Solicitacao updated.',
        'data'    => $solicitacao->toArray(),
      ];
      if ($request->wantsJson()) {
        return response()->json($response);
      }
      return redirect()->route('solicitacao.index')->with('message', $response['message']);
    } catch (ValidatorException $e) {
      if ($request->wantsJson()) {
        return response()->json([
          'error'   => true,
          'message' => $e->getMessageBag()
        ]);
      }
      return redirect()->back()->withErrors($e->getMessageBag())->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $comissaoDeleted = $this->comissaoRepository->deleteComissaoGrupo($id);
    $deleted = $this->repository->delete($id);

    if (request()->wantsJson()) {
      return response()->json([
        'message' => 'Solicitacao deleted.',
        'deleted' => $deleted,
      ]);
    }
    return redirect()->back()->with('message', 'Solicitacao deleted.');
  }

}
