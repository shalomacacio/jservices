<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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

    $categorias = DB::table('categoria_servicos')->distinct()->get();
    $tecnologias = DB::table('tecnologias')->distinct()->get();
    $tipoPagamentos = DB::table('tipo_pagamentos')->distinct()->get();
    $tipoAquisicaos = DB::table('tipo_aquisicaos')->distinct()->get();
    $tipoMidia = DB::table('tipo_midias')->distinct()->get();

    $comissaos = $this->comissaoRepository
              ->findWhereBetween('created_at',
              [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()],
              ['*'])->where('funcionario_id', Auth::user()->id);

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos,
      ]);
    }
    return view('solicitacaos.index', compact('solicitacaos', 'categorias', 'tecnologias', 'tipoPagamentos', 'tipoAquisicaos', 'tipoMidia', 'comissaos'));
  }

  public function ajaxServicos(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $categoria = DB::table('categoria_servicos')->where('id', $request->categoria_servico_id)->get();
    $servicos = DB::table('servicos')->where('categoria_servico_id', $request->categoria_servico_id)->get();
    return response()->json([
      'servicos' => $servicos
    ]);
  }

  public function ajaxValor(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $valor = DB::table('servicos')->where('id', $request->servico_id)->first();
    return response()->json([
      'valor' => $valor
    ]);
  }

  public function ajaxCliente(Request $request)
  {
    header('Content-Type: application/json; charset=utf-8');
    $cliente = DB::connection('pgsql')->select('select codpessoa, nome_razaosocial from mk_pessoas where codpessoa =?', [$request->cod_cliente]);

    if ($cliente == null) {
      return response()->json([
        'error'   => true,
        'message' => " Cliente não encontrado"
      ]);
    }

    return response()->json([
      'result' => $cliente
    ]);
  }

  public function encaminhar($id)
  {
    $solicitacao = $this->repository->find($id);
    $tecnicos = DB::table('users as u')
                      ->join('role_user as ru','u.id','=','ru.user_id')
                      ->where('u.id', '<>' ,1)
                      ->get();
    return view('solicitacaos.encaminhar', compact('solicitacao', 'tecnicos'));
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
      return redirect()->route('solicitacoes')->with('message', $response['message']);
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
    $solicitacaos = $this->repository->scopeQuery(function ($query) {
      return $query
        ->whereNotIn('status_solicitacao_id', ['4']) // , 4 - cancelada
        ->where('dt_conclusao', '>=', Carbon::now()->format('Y-m-d 00:00:00'))
        ->where('dt_conclusao', null)
        // ->take(3)
        ->orderBy('created_at', 'desc');
    })->paginate(10);
    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos,
      ]);
    }
    return view('solicitacaos.solicitacoes', compact('solicitacaos'));
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
      $comissao = $this->comissaoRepository->createComissaoAtendimeto($solicitacao);


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

    $categorias = DB::table('categoria_servicos')->distinct()->get();
    $tecnologias = DB::table('tecnologias')->distinct()->get();
    $tipoPagamentos = DB::table('tipo_pagamentos')->distinct()->get();
    $tipoAquisicaos = DB::table('tipo_aquisicaos')->distinct()->get();
    $tipoMidia = DB::table('tipo_midias')->distinct()->get();

    return view('solicitacaos.edit', compact('solicitacao', 'categorias','tecnologias', 'tipoPagamentos', 'tipoAquisicaos', 'tipoMidia' ));
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

      $comissao = $this->comissaoRepository->createComissaoEquipe($solicitacao);

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


  public function update(SolicitacaoUpdateRequest $request, $id)
  {
    try {

      $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

      //se for uma conclusão de solicitacao
      if ($request->status_solicitacao_id = 3) {
        $solicitacao = $this->repository->find($id);
        $solicitacao->status_solicitacao_id = 3;
        $solicitacao->dt_conclusao = Carbon::now();
        $solicitacao->save();

        $comissao = $this->comissaoRepository->createComissaoEquipe($solicitacao);
      } else {
        $solicitacao = $this->repository->update($request->all(), $id);
      }

      $response = [
        'message' => 'Solicitacao updated.',
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
   * Remove the specified resource from storage.
   *
   * @param  int $id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $comissaoDeleted = $this->comissaoRepository->deleteComissao($id);
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
