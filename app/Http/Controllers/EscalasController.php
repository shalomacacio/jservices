<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EscalaCreateRequest;
use App\Http\Requests\EscalaUpdateRequest;
use App\Repositories\EscalaRepository;
use App\Validators\EscalaValidator;
use DB;
use Carbon\Carbon;
use App\Entities\Escala;
use App\Entities\Solicitacao;

/**
 * Class EscalasController.
 *
 * @package namespace App\Http\Controllers;
 */
class EscalasController extends Controller
{
    /**
     * @var EscalaRepository
     */
    protected $repository;

    /**
     * @var EscalaValidator
     */
    protected $validator;

    /**
     * EscalasController constructor.
     *
     * @param EscalaRepository $repository
     * @param EscalaValidator $validator
     */
    public function __construct(EscalaRepository $repository, EscalaValidator $validator)
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
      $data = Carbon::now()->format('Y-m-d 00:00:00');
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $data =  Carbon::now()->format('Y-m-d 00:00:00');
        // $escalas = $result->where('dt_escala', '>=' , Carbon::now()->format('Y-m-d 00:00:00'));
        $escalas = $this->repository->scopeQuery(function ($query) use($data) {
          return $query
            ->where('dt_escala','>=', $data)
            ->orderBy('dt_escala', 'desc');
        })->get();


        $users = DB::table('users as u')
                      ->join('role_user as ru','u.id','=','ru.user_id')
                      ->where('u.id', '<>' ,1)
                      ->get();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $escalas,
            ]);
        }

        return view('escalas.index', compact('escalas', 'users'));
    }

    // public function agenda(Request $request){

    //   $data = Carbon::now()->format('Y-m-d');

    //   $result = DB::table('solicitacaos as s')
    //     ->join('status_solicitacaos as ss', 's.status_solicitacao_id', '=', 'ss.id')
    //     ->join('categoria_servicos as cs', 'cs.id', '=', 's.categoria_servico_id')
    //     ->join('users as u', 's.user_atendimento_id', '=', 'u.id')
    //     ->whereNull('s.deleted_at')
    //     ->where('s.dt_agendamento', '>=' , Carbon::parse($data)->format('Y-m-d 00:00:00'))
    //     ->where('s.dt_agendamento', '<=' , Carbon::parse($data)->format('Y-m-d 23:59:59'))
    //     ->select('cs.descricao as descricao', 'cs.max_diario as maximo' ,'s.nome_razaosocial as cliente', 's.turno_agendamento as turno', 's.status_solicitacao_id' , 'u.name as funcionario', 'ss.descricao as status')
    //     ->orderBy('descricao')
    //     ->get();
    //   $solicitacoes = $result->groupBy('descricao', 'maximo');
    //   return view('escalas.agenda', compact('solicitacoes', 'data'));
    // }

    public function agenda(Request $request){
      $data = Carbon::now()->format('Y-m-d');

      if($request->dt_escala){
        $data = $request->dt_escala;
      }

      $result = DB::table('solicitacaos as s')
        ->leftJoin('solicitacao_user as su', 'su.solicitacao_id', '=', 's.id' )
        ->leftJoin('users as u2', 'su.user_id', '=', 'u2.id')
        ->join('status_solicitacaos as ss', 's.status_solicitacao_id', '=', 'ss.id')
        ->join('categoria_servicos as cs', 'cs.id', '=', 's.categoria_servico_id')
        ->join('users as u', 's.user_atendimento_id', '=', 'u.id')
        ->whereNull('s.deleted_at')
        ->where('s.dt_agendamento', '>=' , Carbon::parse($data)->format('Y-m-d 00:00:00'))
        ->where('s.dt_agendamento', '<=' , Carbon::parse($data)->format('Y-m-d 23:59:59'))
        ->select('s.id', 'cs.descricao as descricao', 'cs.max_diario as maximo' ,
        's.nome_razaosocial as cliente', 's.turno_agendamento as turno', 's.status_solicitacao_id' ,
        'u.name as funcionario', 'ss.descricao as status', 'u2.name as tecnico')
        ->get();

        $solicitacoes = $result;

        $aberto = $result->where('status_solicitacao_id', '=', 1)->count();
        $encaminhado = $result->where('status_solicitacao_id', '=', 2)->count();
        $concluido = $result->where('status_solicitacao_id', '=', 3)->count();
        $retorno = $result->where('status_solicitacao_id', '=', 6)->count();

        $porAtend = $result->groupBy('funcionario');
        $porServ = $result->groupBy('descricao');
        $porTec = $result->groupBy('tecnico');

      return view('escalas.agenda2', compact('solicitacoes', 'aberto','encaminhado' ,'retorno', 'concluido', 'porAtend', 'porServ', 'porTec', 'data'));
    }



    public function escala(Request $request){

      try {
        $escala = Escala::where('dt_escala', '>=' , Carbon::now()->format('Y-m-d 00:00:00' ))
        ->where('dt_escala', '<=' , Carbon::now()->format('Y-m-d 23:59:59' ))
        ->firstOrFail();

        $totalPontos =  $escala->users->sum('max_ponto') ;

        $sumPontos = DB::table('solicitacaos as s')
                      ->join('categoria_servicos as cs', 'cs.id', '=', 's.categoria_servico_id')
                      ->whereNull('s.deleted_at')
                      ->where('s.dt_agendamento', '>=' , Carbon::parse($request->dt_escala)->format('Y-m-d 00:00:00'))
                      ->where('s.dt_agendamento', '<=' , Carbon::parse($request->dt_escala)->format('Y-m-d 23:59:59'))
                      ->sum('cs.pontuacao');

        $pontosDisponiveis = $totalPontos - $sumPontos;

        // return dd($sumPontos);

        return view('escalas.agenda', compact('escala', 'totalPontos', 'sumPontos', 'pontosDisponiveis' ));

      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $message = 'não existe escala cadastrada ';
        $escala = null;
        $totalPontos = 0;
        $sumPontos = 0;
        // return redirect()->route('escalas.agenda')->withErrors( $message);
        return view('escalas.agenda', compact('escala', 'totalPontos', 'sumPontos' ))->withErrors( $message);
      }
    }

    public function search(Request $request){
      $data = Carbon::now()->format('Y-m-d');
      if($request){
        $data = $request->dt_escala;
      }
      try {
        $result = DB::table('solicitacaos as s')
        ->join('status_solicitacaos as ss', 's.status_solicitacao_id', '=', 'ss.id')
        ->join('categoria_servicos as cs', 'cs.id', '=', 's.categoria_servico_id')
        ->join('users as u', 's.user_atendimento_id', '=', 'u.id')
        ->whereNull('s.deleted_at')
        ->where('s.dt_agendamento', '>=' , Carbon::parse($data)->format('Y-m-d 00:00:00'))
        ->where('s.dt_agendamento', '<=' , Carbon::parse($data)->format('Y-m-d 23:59:59'))
        ->select('cs.descricao as descricao', 'cs.max_diario as maximo' ,'s.nome_razaosocial as cliente', 's.turno_agendamento as turno', 's.status_solicitacao_id' , 'u.name as funcionario', 'ss.descricao as status')
        ->orderBy('descricao')
        ->get();
        $solicitacoes = $result->groupBy('descricao', 'maximo');
        return view('escalas.agenda', compact('solicitacoes', 'data'));

      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $message = 'não existe escala cadastrada ';
        $escala = null;
        $totalPontos = 0;
        $sumPontos = 0;
        // return redirect()->route('escalas.agenda')->withErrors( $message);
        return view('escalas.agenda', compact('escala', 'totalPontos', 'sumPontos' ))->withErrors( $message);
      }
    }

    public function searchEscala(Request $request){
      try {
        $escala = Escala::where('dt_escala', '>=' , Carbon::parse($request->dt_escala)->format('Y-m-d 00:00:00' ))
        ->where('dt_escala', '<=' , Carbon::parse($request->dt_escala)->format('Y-m-d 23:59:59' ))
        ->firstOrFail();
        $totalPontos =  $escala->users->sum('max_ponto') ;
        $sumPontos = DB::table('solicitacaos as s')
                      ->join('categoria_servicos as cs', 'cs.id', '=', 's.categoria_servico_id')
                      ->whereNull('s.deleted_at')
                      ->where('s.dt_agendamento', '>=' , Carbon::parse($request->dt_escala)->format('Y-m-d 00:00:00'))
                      ->where('s.dt_agendamento', '<=' , Carbon::parse($request->dt_escala)->format('Y-m-d 23:59:59'))
                      ->sum('cs.pontuacao');
        $pontosDisponiveis = $totalPontos - $sumPontos;
        return view('escalas.agenda', compact('escala', 'totalPontos', 'sumPontos', 'pontosDisponiveis' ));
      } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $message = 'não existe escala cadastrada ';
        $escala = null;
        $totalPontos = 0;
        $sumPontos = 0;
        // return redirect()->route('escalas.agenda')->withErrors( $message);
        return view('escalas.agenda', compact('escala', 'totalPontos', 'sumPontos' ))->withErrors( $message);
      }
    }
    public function pendentes(){

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  EscalaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EscalaCreateRequest $request)
    {
        try {

          // return dd($request);

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            // $escala = $this->repository->create($request->all());
            $escala = $this->repository->createHasMany($request->all());
            $response = [
                'message' => 'Escala created.',
                // 'data'    => $escala->toArray(),
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
      $escala = $this->repository->find($id);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $escala,
            ]);
        }
      return view('escalas.show', compact('escala'));
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
        $escala = $this->repository->find($id);
        $users = DB::table('users as u')
        ->join('role_user as ru','u.id','=','ru.user_id')
        ->where('u.id', '<>' ,1)
        ->get();
        return view('escalas.edit', compact('escala', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EscalaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EscalaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $escala = $this->repository->updateHasMany($request->all(), $id);

            $response = [
                'message' => 'Escala updated.',
                // 'data'    => $escala->toArray(),
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
                'message' => 'Escala deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Escala deleted.');
    }
}
