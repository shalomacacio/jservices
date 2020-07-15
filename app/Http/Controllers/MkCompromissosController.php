<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MkCompromissoCreateRequest;
use App\Http\Requests\MkCompromissoUpdateRequest;
use App\Repositories\MkCompromissoRepository;
use App\Validators\MkCompromissoValidator;
use Carbon\Carbon;
use App\Entities\MkCompromisso;
use DB;

/**
 * Class MkCompromissosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MkCompromissosController extends Controller
{
    /**
     * @var MkCompromissoRepository
     */
    protected $repository;

    /**
     * @var MkCompromissoValidator
     */
    protected $validator;

    /**
     * MkCompromissosController constructor.
     *
     * @param MkCompromissoRepository $repository
     * @param MkCompromissoValidator $validator
     */
    public function __construct(MkCompromissoRepository $repository, MkCompromissoValidator $validator)
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
        $mkCompromissos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkCompromissos,
            ]);
        }

        return view('mkCompromissos.index', compact('mkCompromissos'));
    }

    public function agenda(Request $request){
      $inicio = Carbon::now()->format('Y-m-d 00:00:00');
      $fim = Carbon::now()->format('Y-m-d 23:59:59');

      if($request->dt_escala){
        $inicio = Carbon::parse($request->dt_escala)->format('Y-m-d 00:00:00');
        $fim = Carbon::parse($request->dt_escala)->format('Y-m-d 23:59:59');
      }

      // Tipos de OS
      $tipos = [2,5,6,111,133,138];

      $result = DB::connection('pgsql')->table('mk_compromissos as comp')
                ->join('mk_compromisso_pessoa as compessoa', 'compessoa.codcompromisso', '=', 'comp.codcompromisso')
                ->join('mk_os as os', 'os.codos','=', 'comp.cd_integracao')
                ->join('mk_os_tipo as tipoOs', 'tipoOs.codostipo','=', 'os.tipo_os')
                ->leftJoin('mk_pessoas as func', 'func.codpessoa', '=','compessoa.cdpessoa')
                ->whereBetween('comp.com_inicio', [$inicio, $fim])
                ->select
                  ('comp.com_titulo',
                  'func.nome_razaosocial',
                  'tipoOs.descricao as servico',
                  'os.dh_inicio_atividade',
                  'os.dh_fim_atividade',
                  'os.ultimo_status_app_mk',
                  'os.ultimo_status_app_mk_tx'
                  )
                ->get();
      $comps = $result->groupBy('nome_razaosocial');

      return view('agenda.index', compact('comps'));
    }
}
