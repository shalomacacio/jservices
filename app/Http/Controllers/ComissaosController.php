<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ComissaoCreateRequest;
use App\Http\Requests\ComissaoUpdateRequest;
use App\Repositories\ComissaoRepository;
use App\Validators\ComissaoValidator;
use Illuminate\Support\Facades\DB;
use App\Entities\Comissao;
use App\Entities\Solicitacao;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class ComissaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ComissaosController extends Controller
{
    /**
     * @var ComissaoRepository
     */
    protected $repository;

    /**
     * @var ComissaoValidator
     */
    protected $validator;

    /**
     * ComissaosController constructor.
     *
     * @param ComissaoRepository $repository
     * @param ComissaoValidator $validator
     */
    public function __construct(ComissaoRepository $repository, ComissaoValidator $validator)
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
        $comissaos = $this->repository->all();
        $tipoComissaos = DB::table('tipo_comissaos')->get();
        if (request()->wantsJson()) {

          return response()->json([
              'data' => $comissaos,
          ]);
        }
        return view('comissaos.minhas_comissoes', compact('comissaos', 'tipoComissaos'));
    }


    // --  MODO ANTIGO ---
    // public function autorizarComissoes()
    // {
    //   $comissaos = $this->repository->scopeQuery(function ($query) {
    //     return $query
    //     ->where('flg_autorizado', '=', 3)
    //     ->orderBy('dt_referencia', 'desc');
    //   })->get();

    //   if (request()->wantsJson()) {
    //     return response()->json([
    //       'data' => $comissaos,
    //     ]);
    //   }
    //     return view('comissaos.autorizarComissoes', compact('comissaos'));
    // }


    public function autorizarComissoes()
    {
      $result = DB::table('solicitacaos as s')
                  ->join('solicitacao_user as su', 's.id', '=', 'su.solicitacao_id')
                  ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
                  ->join('users as ua', 's.user_atendimento_id', '=', 'ua.id')
                  ->join('users as ut', 'su.user_id', '=', 'ut.id')
                  ->whereNull('s.deleted_at')
                  ->whereNull('s.dt_aut_fin')
                  ->whereNotNull('s.codatendimento')
                  ->whereNotNull('s.dt_conclusao')
                  ->where('dt_conclusao', '>=', '2020-04-01 00:00:00')
                  ->select(
                    's.id' ,'s.dt_conclusao', 's.nome_razaosocial','s.status_solicitacao_id','s.vlr_plano', 's.vlr_servico','s.codatendimento',
                    'cs.descricao as servico',
                    'ut.name as tecnico',
                    'ua.name as consultor')
                    ->orderBy('s.dt_conclusao');

      $solicitacaos = $result->get();

        return view('comissaos.autorizarComissoes', compact('solicitacaos'));
    }

    // public function minhasComissoes()
    // {
    //     $start = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
    //     $end = Carbon::now()->endOfMonth()->format('Y-m-d 23:59:59');

    //     $result = $this->repository->scopeQuery(function ($query) use(  $start, $end )  {
    //       return $query
    //         ->where('funcionario_id', Auth::user()->id)
    //         ->whereDate('dt_referencia', '>=', $start)
    //         ->whereDate('dt_referencia', '<=', $end)
    //         ->orderBy('dt_referencia', 'desc');
    //     });

    //     $result2  = DB::table('comissaos')
    //               ->where('funcionario_id', Auth::user()->id)
    //               ->whereDate('dt_referencia', '>=', $start)
    //               ->whereDate('dt_referencia', '<=', $end)
    //               ->orderBy('dt_referencia', 'desc')->get();

    //     $comissaos = $result->paginate(10);

    //     $aguardando = $result2->where('flg_autorizado','=' , 3 )->sum('comissao_vlr');
    //     $nAutorizado = $result2->where('flg_autorizado','=' , '0' )->sum('comissao_vlr');
    //     $autorizado = $result2->where('flg_autorizado','=' , 1 )->sum('comissao_vlr');

    //     if (request()->wantsJson()) {
    //         return response()->json([
    //             'data' => $comissaos,
    //         ]);
    //     }
    //     return view('comissaos.minhas_comissoes', compact('comissaos', 'aguardando', 'nAutorizado', 'autorizado'));
    // }

    public function minhasComissoes()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d 23:59:59');

        $result = DB::table('solicitacaos as s')
                    ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
                    ->join('users as u','s.user_atendimento_id', 'u.id')
                    ->where('user_atendimento_id', Auth::user()->id)
                    ->whereBetween('dt_conclusao', [$start, $end])
                    ->select('s.dt_conclusao','s.nome_razaosocial', 's.status_comissao','s.vlr_plano', 's.vlr_servico',
                    'u.name as colaborador',
                    'cs.descricao as servico');

        $result2 = DB::table('solicitacaos as s')
                    ->where('user_atendimento_id', Auth::user()->id)
                    ->whereBetween('dt_conclusao', [$start, $end])
                    ->get();


        $solicitacaos = $result->orderBy('dt_conclusao', 'desc')->paginate('10');

        $aguardando = $result2->where('status_comissao', null)->count();
        $nAutorizado = $result2->where('status_comissao', 2)->count();
        $autorizado = $result2->where('status_comissao', 1)->count();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $solicitacaos,
            ]);
        }
        return view('comissaos.minhas_comissoes', compact('solicitacaos', 'aguardando', 'nAutorizado', 'autorizado'));
    }

    public function pesquisar()
    {
        $users = DB::table('users')->get();
        return view('comissaos.pesquisar', compact('users'));
    }

    public function pesquisarMinhasComissoes()
    {
        $users = DB::table('users')->get();
        return view('comissaos.pesquisar', compact('users'));
    }

    public function search(Request $request){
      $result= $this->repository->scopeQuery(function ($query) use ($request) {
        return $query
          ->where('funcionario_id', Auth::user()->id)
          ->whereDate('dt_referencia', '>=' , $request->dt_inicio)
          ->whereDate('dt_referencia', '<=' , $request->dt_fim);
      })->get();

      $comissaos = $result;
      $aguardando = $result->where('flg_autorizado', 3 )->sum('comissao_vlr');
      $nAutorizado = $result->where('flg_autorizado', 0 )->sum('comissao_vlr');
      $autorizado = $result->where('flg_autorizado', 1 )->sum('comissao_vlr');
      return view('comissaos.minhas_comissoes', compact('comissaos', 'aguardando', 'nAutorizado', 'autorizado'));
    }

    public function autorizar(Request $request, $id)
    {
      // return dd($id);
      $solicitacao = Solicitacao::find($id);
      $solicitacao->dt_aut_fin = Carbon::now();
      $solicitacao->user_aut_fin = Auth::user()->id;
      $solicitacao->status_comissao = $request->status_comissao;
      $solicitacao->save();
      $response = [
        'message' => 'Realizado com Sucesso.',
        'data'    => $solicitacao->toArray(),
      ];
      return redirect()->back()->with('message', $response['message']);
    }

    public function nAutorizar(Request $request, $id)
    {
            // return dd($id);
            $solicitacao = Solicitacao::find($id);
            $solicitacao->dt_aut_fin = Carbon::now();
            $solicitacao->user_aut_fin = Auth::user()->id;
            $solicitacao->status_comissao = $request->status_comissao;
            $solicitacao->obs = $request->obs;
            $solicitacao->save();
            $response = [
              'message' => 'Realizado com Sucesso.',
              'data'    => $solicitacao->toArray(),
            ];
      return redirect()->back()->with('message', $response['message']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ComissaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ComissaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $comissao = $this->repository->create($request->all());

            $response = [
                'message' => 'Comissao created.',
                'data'    => $comissao->toArray(),
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
        $comissao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comissao,
            ]);
        }

        return view('comissaos.show', compact('comissao'));
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
        $comissao = $this->repository->find($id);
        $tipoComissaos = DB::table('tipo_comissaos')->get();

        return view('comissaos.edit', compact('comissao', 'tipoComissaos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ComissaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ComissaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $comissao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Comissao updated.',
                'data'    => $comissao->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('comissaos.index')->with('message', $response['message']);
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
                'message' => 'Comissao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Comissao deleted.');
    }
}
