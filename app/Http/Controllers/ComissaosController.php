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

    public function minhasComissoes(Request $request)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d 23:59:59');

        if($request->dt_inicio){
          $start = Carbon::parse($request->dt_inicio)->format('Y-m-d 00:00:00');
        }
        if($request->dt_fim){
          $end = Carbon::parse($request->dt_fim)->format('Y-m-d 23:59:59');
        }

        // $tipos = [2,5,6,111,133,138];

        $result = DB::connection('pgsql')->table('mk_os as  os')
        ->join('mk_pessoas as cliente', 'os.cliente', 'cliente.codpessoa')
        ->leftJoin('fr_usuario as u', 'os.operador_fech_tecnico', 'u.usr_codigo')
        ->leftJoin('fr_usuario as u2', 'os.tecnico_responsavel', 'u2.usr_codigo')
        ->leftJoin('mk_pessoas as consul', 'os.tecnico_responsavel', 'consul.codpessoa')
        ->leftJoin('mk_pessoas as tec', 'os.operador_fech_tecnico', 'tec.id_alternativo')
        ->leftJoin('mk_os_tipo as tip', 'os.tipo_os', 'tip.codostipo')
        ->leftJoin('mk_os_classificacao_encerramento as classificacao', 'os.classificacao_encerramento', 'classificacao.codclassifenc')
        ->leftJoin('mk_atendimento as atend', 'os.cd_atendimento', 'atend.codatendimento')
        ->leftJoin('mk_conexoes as conex',  'cliente.codpessoa', 'conex.codcliente')
        ->leftJoin('mk_contratos as cont', 'conex.contrato', 'cont.codcontrato' )
        ->where('os.data_fechamento', $end)
        // ->whereBetween('os.data_fechamento', [$start, $end])
        // ->whereIn('tipo_os', $tipos)
        ->select(
          'os.codos',
          'os.data_abertura',
          'os.data_fechamento',
          'os.dt_hr_fechamento_tec',
          'os.tx_extra',
          'os.indicacoes',
          'os.operador_fech_tecnico',
          'u.usr_nome',
          'u2.usr_nome as consult2',
          'os.operador',
          'cliente.inativo',
          'atend.operador_abertura',
          'cliente.nome_razaosocial as cliente',
          'consul.nome_razaosocial as consultor',
          'tec.nome_razaosocial as tecnico',
          'tip.descricao as tipo',
          'cont.vlr_renovacao',
          'os.classificacao_encerramento',
          'classificacao.classificacao',
          'classificacao.codclassifenc',
          'os.servico_prestado'
        );
        // ->orderBy('os.data_fechamento', 'asc')
        // ->get();

        $ordens = $result->orderBy('os.data_fechamento', 'asc')->orderBy('u.usr_nome')->get();


        $autorizado = $result->where('codclassifenc', '40' )->count();
        $nAutorizado = $result->where('codclassifenc', '29' )->count();

        return view('comissaos.minhas_comissoes', compact('ordens', 'nAutorizado', 'autorizado', 'request'));
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
      $result = DB::table('solicitacaos as s')
      ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
      ->join('users as u','s.user_atendimento_id', 'u.id')
      ->where('user_atendimento_id', Auth::user()->id)
      ->whereBetween('s.dt_conclusao', [$request->dt_inicio, $request->dt_fim])
      ->select(
      's.dt_conclusao','s.nome_razaosocial', 's.status_comissao','s.vlr_plano', 's.vlr_servico',
      'u.name as colaborador',
      'cs.descricao as servico');

      $solicitacaos = $result;
      $aguardando = 0; //$result->where('flg_autorizado', 3 )->sum('comissao_vlr');
      $nAutorizado = 0; // $result->where('flg_autorizado', 0 )->sum('comissao_vlr');
      $autorizado = 0; // $result->where('flg_autorizado', 1 )->sum('comissao_vlr');
      return view('comissaos.minhas_comissoes', compact('solicitacaos', 'aguardando', 'nAutorizado', 'autorizado'));
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
