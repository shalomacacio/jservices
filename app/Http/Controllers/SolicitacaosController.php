<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SolicitacaoCreateRequest;
use App\Http\Requests\SolicitacaoUpdateRequest;
use App\Repositories\SolicitacaoRepository;
use App\Validators\SolicitacaoValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function __construct(SolicitacaoRepository $repository, SolicitacaoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $solicitacaos = $this->repository->scopeQuery(function($query){
            return $query
                ->where('user_id', Auth::user()->id)
                // ->where('status', 1)
                // ->take(3)
                ->orderBy('created_at','desc');
        })->paginate(10);
        $categorias = DB::table('categoria_servicos')->distinct()->get();
        $tecnologias = DB::table('tecnologias')->distinct()->get();
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $solicitacaos,
            ]);
        }
        return view('solicitacaos.index', compact('solicitacaos', 'categorias', 'tecnologias'));
    }

    public function ajaxServicos(Request $request)
    {
      header('Content-Type: application/json; charset=utf-8');
      $categoria = DB::table('categoria_servicos')->where('id', $request->categoria_servico_id)->get();
      $servicos = DB::table('servicos')->where('categoria_servico_id', $request->categoria_servico_id )->get();
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

    public function encaminhar($id)
    {
        $solicitacao = $this->repository->find($id);
        $tecnicos = DB::table('tecnicos')->distinct()->get();
        return view('solicitacaos.encaminhar', compact('solicitacao', 'tecnicos'));
    }

    public function atribuir(Request $request)
    {
        try {
            $solicitacao = $this->repository->find($request->solicitacao_id);
            $comissaoTecnico = $solicitacao->comissao_equipe / count($request->equipe);
            //vincula solicitação a equipe
            $solicitacao->tecnicos()->attach($request->equipe, ['comissao_tecnico'=> $comissaoTecnico]);
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
        $solicitacaos = $this->repository->scopeQuery(function($query){
            return $query
                // ->whereNotIn('status_solicitacao_id', ['4']) // , 4 - cancelada
                ->where('status_solicitacao_id','<>',' 4')
                ->where('flg_autorizado', null)
                // ->take(3)
                ->orderBy('created_at','desc');
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
        return view('solicitacaos.edit', compact('solicitacao'));
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
    public function update(SolicitacaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $solicitacao = $this->repository->update($request->all(), $id);
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
