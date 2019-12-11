<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Entities\User;
use App\Entities\Comissao;

use App\Repositories\ReportRepository;
use App\Repositories\ComissaoRepository;
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
    protected $repository;
    protected $comissaoRepository;
    protected $userRepository;


    /**
     * ReportsController constructor.
     *
     * @param ReportRepository $repository
     * @param ReportValidator $validator
     */
    public function __construct(ReportRepository $repository, UserRepository $userRepository, ComissaoRepository $comissaoRepository)
    {
        $this->repository = $repository;
        $this->comissaoRepository = $comissaoRepository;
        $this->userRepository = $userRepository;
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

    public function formFunc()
    {
        return view('reports.formFunc');
    }

    public function formCom()
    {
        return view('reports.formCom');
    }



    public function users(Request $request)
    {
        $this->userRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $users =  $this->comissaoRepository->scopeQuery(function($query) use ($request) {
          $queryB = $query->where('flg_autorizado', '<>', null)
                  ->whereDate ('dt_referencia', '>=', $request->dt_inicio)
                  ->whereDate ('dt_referencia', '<=', $request->dt_fim);

          return $query->select('*')
              ->join('users as u','u.id','=','comissaos.funcionario_id')
              ->union($queryB);
        })->get();

      // return dd($users);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $users,
            ]);
        }

        return view('reports.users', compact('users'));
    }

    public function comissoes(Request $request)
    {
        $this->comissaoRepository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        // $comissoes = Comissao::where('flg_autorizado', '<>', null)
        //         ->whereDate ('dt_referencia', '>=', $request->dt_inicio)
        //         ->whereDate ('dt_referencia', '<=', $request->dt_fim)
        //         ->get();

        $comissoes = $this->comissaoRepository->scopeQuery(function($query) use ($request){
                  return $query
                  ->where ('dt_referencia', '>=', $request->dt_inicio)
                  ->where ('dt_referencia', '<=', $request->dt_fim)
                  ->join('users','users.id','=','comissaos.funcionario_id');
                })->get();

        // $comissoes = DB::table('comissaos')
        //               ->join('users', 'users.id', '=', 'comissaos.funcionario_id')
        //               ->join('solicitacaos', 'solicitacaos.id', '=', 'comissaos.solicitacao_id')
        //               ->select(DB::raw('MAX(dt_referencia) as data'),'users.name','solicitacaos.cliente', DB::raw('SUM(comissao_vlr) as subtotal'))
        //               ->where('dt_referencia', '>=', $request->dt_inicio)
        //               ->where('dt_referencia', '<=', $request->dt_fim)
        //               ->groupBy([ DB::raw('users.name, solicitacaos.cliente WITH ROLLUP' )])
        //               ->get();

      return dd($comissoes);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $comissoes,
            ]);
        }

        return view('reports.comissoes', compact('comissoes', 'request'));
    }



}
