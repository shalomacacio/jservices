<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Entities\User;
use App\Entities\Comissao;

use App\Repositories\ReportRepository;
use App\Repositories\ComissaoRepository;
use App\Repositories\SolicitacaoRepository;
use App\Repositories\TipoMidiaRepository;
use App\Repositories\UserRepository;

use DB;

use Carbon\Carbon;

/**
 * Class ReportsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ReportsController extends Controller
{
    /**
     * @var ReportRepository
     */
    protected $comissaoRepository;
    protected $solicitacaoRepository;
    protected $userRepository;
    protected $tipoMidiaRepository;


    /**
     * ReportsController constructor.
     *
     * @param ReportRepository $repository
     * @param ReportValidator $validator
     */
    public function __construct(
        UserRepository $userRepository,
        ComissaoRepository $comissaoRepository,
        TipoMidiaRepository $tipoMidiaRepository,
        SolicitacaoRepository $solicitacaoRepository)
    {
        $this->comissaoRepository = $comissaoRepository;
        $this->userRepository = $userRepository;
        $this->tipoMidiaRepository = $tipoMidiaRepository;
        $this->solicitacaoRepository = $solicitacaoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    public function comissaoForm()
    {
      $users = $this->userRepository->all();
      return view('reports.comissaoForm', compact('users'));
    }

    public function servicosForm()
    {
      $users = $this->userRepository->all();
      return view('reports.servicosForm', compact('users'));
    }

    public function comissoes(Request $request)
    {
        if($request->funcionario_id != 0){
          $result =  $this->comissaoRepository->scopeQuery(function($query) use ($request) {
            return $query->whereIn('flg_autorizado', [0,1])
                    ->where('funcionario_id', '=' , $request->funcionario_id)
                    ->whereDate ('dt_referencia', '>=', $request->dt_inicio)
                    ->whereDate ('dt_referencia', '<=', $request->dt_fim);

          })->get();
        } else {
          $result =  $this->comissaoRepository->scopeQuery(function($query) use ($request) {
            return $query->whereIn('flg_autorizado', [0,1])
                    ->whereDate ('dt_referencia', '>=', $request->dt_inicio)
                    ->whereDate ('dt_referencia', '<=', $request->dt_fim);

          })->get();

        }

        $comissaos = $result->groupBy('funcionario_id');

        $total = $result->where('flg_autorizado', '=' , 1)->sum('comissao_vlr');

      // return dd($total);
        if (request()->wantsJson()) {
            return response()->json([
                'data' => $comissaos,
            ]);
        }
        return view('reports.comissoes', compact('comissaos', 'request', 'total'));
    }

    public function servicos(Request $request)
    {
        if($request->user_id != 0){
          $result =  $this->solicitacaoRepository->scopeQuery(function($query) use ($request) {
            return $query
                    ->where('user_id', '=' , $request->user_id)
                    ->join('users as u', 'u.id', '=', 'user_id')
                    ->join('servicos as s', 's.id', '=', 'servico_id')
                    ->whereDate ('solicitacaos.created_at', '>=', $request->dt_inicio)
                    ->whereDate ('solicitacaos.created_at', '<=', $request->dt_fim);

          })->get();
        } else {
          $result =  $this->solicitacaoRepository->scopeQuery(function($query) use ($request) {
            return $query
                    ->join('users as u', 'u.id', '=', 'user_id')
                    ->join('servicos as s', 's.id', '=', 'servico_id')
                    ->whereDate ('solicitacaos.created_at', '>=', $request->dt_inicio)
                    ->whereDate ('solicitacaos.created_at', '<=', $request->dt_fim);
          })->get();
        }

        $solicitacaos = $result;

        $total = $result->count();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $solicitacaos,
            ]);
        }
        return view('reports.servicos', compact('solicitacaos', 'request', 'total'));
    }



    public function midias()
    {
      $result =  $this->solicitacaoRepository->scopeQuery(function($query) {
        return $query
                ->join('tipo_midias as tm', 'tm.id', '=', 'tipo_midia_id');
                // ->whereIn('categoria_servico_id', [1, 5]);

      })->get();

      $solicitacaos = $result;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $solicitacaos,
            ]);
        }
        return view('reports.midias', compact('solicitacaos'));
    }



}
