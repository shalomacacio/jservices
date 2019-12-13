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

        $comissaos =  $this->comissaoRepository->scopeQuery(function($query) use ($request) {
          return $query->whereNotNull('flg_autorizado')
                  ->whereDate ('dt_referencia', '>=', $request->dt_inicio)
                  ->whereDate ('dt_referencia', '<=', $request->dt_fim);

        })->get()->groupBy('funcionario_id');

      // return dd($comissaos);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $comissaos,
            ]);
        }

        return view('reports.users', compact('comissaos', 'request'));
    }

}
