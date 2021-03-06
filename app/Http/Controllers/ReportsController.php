<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Entities\User;
use App\Entities\Comissao;
use App\Entities\FrUsuario;
use App\Entities\MkOs;
use App\Entities\MkOsTipo;
use App\Entities\MkPessoa;
use App\Repositories\ReportRepository;
use App\Repositories\ComissaoRepository;
use App\Repositories\SolicitacaoRepository;
use App\Repositories\TipoMidiaRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;

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
    SolicitacaoRepository $solicitacaoRepository
  ) {
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
    $roles = [2, 5, 8];
    $autor = [0, 1, 3];
    if ($request->roles) {
      $roles = $request->roles;
    }

    if ($request->flags) {
      $autor = $request->flags;
    }

    if ($request->funcionario_id != 0) {
      $result =  $this->comissaoRepository->scopeQuery(function ($query) use ($request,  $autor) {
        return $query
          ->whereIn('flg_autorizado',  $autor)
          ->where('funcionario_id', '=', $request->funcionario_id)
          ->whereDate('dt_referencia', '>=', $request->dt_inicio)
          ->whereDate('dt_referencia', '<=', $request->dt_fim)
          ->orderBy('dt_referencia', 'asc');
      })->get();
    } else {
      $result =  $this->comissaoRepository->scopeQuery(function ($query) use ($request, $roles,  $autor) {
        return $query
          ->join('role_user as ru', 'comissaos.funcionario_id', 'ru.user_id')
          ->whereIn('flg_autorizado',  $autor)
          ->whereIn('ru.role_id', $roles)
          ->whereDate('dt_referencia', '>=', $request->dt_inicio)
          ->whereDate('dt_referencia', '<=', $request->dt_fim)
          ->orderBy('dt_referencia', 'asc');
      })->get();
    }

    $comissaos = $result->groupBy('funcionario_id');
    $total = $result->where('flg_autorizado', '=', 1)->sum('comissao_vlr');
    if (request()->wantsJson()) {
      return response()->json([
        'data' => $comissaos,
      ]);
    }
    return view('reports.comissoes', compact('comissaos', 'request', 'total'));
  }

  public function comissoesNovo(Request $request)
  {
    $result = DB::table('comissaos as c')
      ->join('users as u', 'u.id', '=', 'c.funcionario_id')
      ->join('solicitacaos as s', 'c.funcionario_id', '=', 's.user_atendimento_id')
      ->whereDate('c.dt_referencia', '>=', $request->dt_inicio)
      ->whereDate('c.dt_referencia', '<=', $request->dt_fim)
      ->select('c.id as id',  'u.name as name', 's.nome_razaosocial as razao', 'c.dt_referencia as dt_referencia', 'c.flg_autorizado', 'c.comissao_vlr')
      ->orderBy('dt_referencia');

    $comissoes = $result->groupBy('name');
    $total = 0;

    return view('reports.comissoes', compact('comissoes', 'request', 'total'));
  }

  public function relServicosForm()
  {
    $users = DB::table('users as u')->where('u.id', '<>', 1)->get();
    $servicos = DB::table('categoria_servicos as u')->get();
    $tecnicos = DB::table('users as u')
      ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
      ->where('ru.role_id', '=', 5)
      ->get();

    return view('reports.relServicosForm', compact('users', 'tecnicos', 'servicos'));
  }

  public function relServicos(Request $request)
  {

    $dtInicio = Carbon::parse($request->dt_inicio)->format('Y-m-d 00:00:00');
    $dtFim = Carbon::parse($request->dt_fim)->format('Y-m-d 23:59:59');

    if ($request->tecnico_id) {
      $tecnicos = [$request->tecnico_id];
    } else {
      $result = DB::table('users as u')
        ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
        ->where('ru.role_id', 5)
        ->get();

      foreach ($result as $r) {
        $tecnicos[] = $r->id;
      }
    }

    if ($request->funcionario_id) {
      $consultores = [$request->funcionario_id];
    } else {
      $result = DB::table('users as u')->where('u.id', '<>', 1)->select('u.id')->get();
      foreach ($result as $r) {
        $consultores[] = $r->id;
      }
    }

    if ($request->servico_id) {
      $servicos = [$request->servico_id];
    } else {
      $result = DB::table('servicos as s')->select('s.id')->get();
      foreach ($result as $r) {
        $servicos[] = $r->id;
      }
    }


    //Todas as adesões CONCLUIDAS por CONSULTOR e TÉCNICO
    $result = DB::table('solicitacaos as s')
      ->join('solicitacao_user as su', 's.id', '=', 'su.solicitacao_id')
      ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
      ->join('users as ua', 's.user_atendimento_id', '=', 'ua.id')
      ->join('users as ut', 'su.user_id', '=', 'ut.id')
      ->whereNull('s.deleted_at')
      ->whereNotNull('s.dt_conclusao')
      ->whereIn('s.categoria_servico_id', $servicos)
      ->whereIn('ut.id', $tecnicos)
      ->whereIn('s.user_atendimento_id', $consultores)
      ->whereBetween('s.dt_conclusao', [$dtInicio, $dtFim])
      ->select('s.dt_conclusao', 's.nome_razaosocial', 'ua.name as consultor', 'ut.name as tecnico', 's.vlr_plano', 's.vlr_servico', 'cs.descricao as servico')
      ->orderBy('s.dt_conclusao');

    $solicitacaos = $result->get();
    $totalPlano = $result->sum('vlr_plano');
    $totalTaxa = $result->sum('vlr_servico');
    $porConsultor = $result->get()->groupBy('consultor');
    $porTecnico = $result->get()->groupBy('tecnico');


    return view('reports.relServicos', compact('solicitacaos', 'request', 'totalPlano', 'totalTaxa', 'porConsultor', 'porTecnico'));
  }

  public function servicos(Request $request)
  {
    if ($request->user_id != 0) {
      $result =  $this->solicitacaoRepository->scopeQuery(function ($query) use ($request) {
        return $query
          ->where('user_id', '=', $request->user_id)
          ->join('users as u', 'u.id', '=', 'user_id')
          ->join('servicos as s', 's.id', '=', 'servico_id')
          ->whereDate('solicitacaos.created_at', '>=', $request->dt_inicio)
          ->whereDate('solicitacaos.created_at', '<=', $request->dt_fim);
      })->get();
    } else {
      $result =  $this->solicitacaoRepository->scopeQuery(function ($query) use ($request) {
        return $query
          ->join('users as u', 'u.id', '=', 'user_id')
          ->join('servicos as s', 's.id', '=', 'servico_id')
          ->whereDate('solicitacaos.created_at', '>=', $request->dt_inicio)
          ->whereDate('solicitacaos.created_at', '<=', $request->dt_fim);
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

  public function producaoDiariaForm()
  {
    return view('reports.producaoDiariaForm');
  }

  public function producaoDiaria(Request $request)
  {
    $start = Carbon::parse($request->dt_inicio)->format('Y:m:d 00:00:00');
    $end =   Carbon::parse($request->dt_fim)->format('Y:m:d 23:59:59');

    $result = DB::table('solicitacaos as s')
      ->join('users as u', 's.user_atendimento_id', '=', 'u.id')
      ->join('role_user as ru', 's.user_atendimento_id', '=', 'ru.user_id')
      ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
      ->leftJoin('planos as p', 's.plano_id', '=', 'p.id')
      ->whereDate('s.dt_agendamento', '>=', $start)
      ->whereDate('s.dt_agendamento', '<=', $end)
      ->select(
        's.id',
        'u.name as colaborador',
        's.dt_agendamento as data',
        'cs.descricao as categoria',
        's.nome_razaosocial as cliente',
        'p.descricao as plano',
        'ru.role_id as role',
        'ru.user_id as tecnico'
      )
      ->orderBy('colaborador')
      ->get();

    $resultTec = DB::table('solicitacao_user as su')
      ->join('solicitacaos as s', 'su.solicitacao_id', '=', 's.id')
      ->join('users as u', 'su.user_id', '=', 'u.id')
      ->join('categoria_servicos as cs', 's.categoria_servico_id', '=', 'cs.id')
      ->whereDate('s.dt_agendamento', '>=', $start)
      ->whereDate('s.dt_agendamento', '<=', $end)
      ->select('u.name as tecnico', 'u.sobrenome as sobrenome', 'cs.descricao', 'cs.pontuacao')
      ->get();

    $colaboradores = $result->where('role', 2)->groupBy('colaborador');
    $consultores = $result->where('role', 8)->groupBy('colaborador');
    $tecnicos = $resultTec->groupBy('tecnico');

    $solicitacaos = $result->groupBy('categoria');
    $total = $result->count();

    if (request()->wantsJson()) {
      return response()->json([
        'data' => $solicitacaos,
      ]);
    }
    return view('reports.producao_diaria', compact('solicitacaos', 'colaboradores', 'consultores', 'tecnicos', 'total', 'request'));
  }

  public function midias()
  {
    $result =  $this->solicitacaoRepository->scopeQuery(function ($query) {
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


  public function relOsForm()
  {
    $servList = [2,5,6,23,76,82,86,88,92,104,108,109,110,111,132,133,137,138,139];

    $consultores = FrUsuario::select('usr_codigo')
                    ->where('setor_associado', 'ATE')
                    ->whereNull('usr_inicio_expiracao')
                    ->select('usr_codigo', 'usr_nome')
                    ->get();
    // $servicos = DB::table('categoria_servicos as u')->get();
    $servicos = MkOsTipo::whereIn('codostipo', $servList)->orderBy('descricao', 'asc')->get();
    $tecnicos = DB::connection('pgsql')->table('fr_usuario')
                        ->where('setor_associado', 'TEC')
                        ->where('cd_perfil_acesso', 6)
                        ->whereNull('usr_inicio_expiracao')
                        ->select('usr_codigo', 'usr_nome')
                        ->get();

    return view('reports.relOsForm', compact('consultores', 'tecnicos', 'servicos'));
  }

  public function relOs(Request $request)
  {
    // Datas
    $dtInicio = Carbon::parse($request->dt_inicio)->format('Y-m-d 00:00:00');
    $dtFim = Carbon::parse($request->dt_fim)->format('Y-m-d 23:59:59');

    if ($request->tecnico_id) {
      $tecnicos[] = $request->tecnico_id;
    } else {
      $result = FrUsuario::select('usr_codigo')->get();

      foreach ($result as $r) {
        $tecnicos[] = $r->usr_codigo;
      }
    }

    // Tipos de OS
    if ($request->codostipo) {
      $tipos = $request->codostipo;
    } else {
      $result = MkOsTipo::select('codostipo')->get();
      foreach ($result as $r) {
        $tipos[] = $r->codostipo;
      }
    }

    //Consultores
    if ($request->consultor_id) {
      $consultores[] = $request->consultor_id;
    } else {
      $result = FrUsuario::select('usr_codigo')->get();
      foreach ($result as $r) {
        $consultores[] = $r->usr_codigo;
      }
    }

    // return dd($consultores);
    if ($request->tipo_pesquisa == 1) {
      $result = DB::connection('pgsql')->table('mk_os as  os')
        ->leftjoin('mk_contratos as contrato', 'os.cd_contrato', 'contrato.codcontrato')
        ->join('mk_pessoas as cliente', 'os.cliente', 'cliente.codpessoa')
        ->leftJoin('fr_usuario as u', 'os.operador_fech_tecnico', 'u.usr_codigo')
        ->leftJoin('fr_usuario as u2', 'os.tecnico_responsavel', 'u2.usr_codigo')
        ->leftJoin('mk_pessoas as consul', 'os.tecnico_responsavel', 'consul.codpessoa')
        ->leftJoin('mk_pessoas as tec', 'os.operador_fech_tecnico', 'tec.id_alternativo')
        ->leftJoin('mk_os_tipo as tip', 'os.tipo_os', 'tip.codostipo')
        ->leftJoin('mk_atendimento as atend', 'os.cd_atendimento', 'atend.codatendimento')
        // ->leftJoin('mk_conexoes as conex',  'cliente.codpessoa', 'conex.codcliente')
        // ->leftJoin('mk_contratos as cont', 'conex.contrato', 'cont.codcontrato' )
        // ->where('os.operador_fech_tecnico', 1318)
        ->whereBetween('os.data_abertura', [$dtInicio, $dtFim])
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
          'os.cd_contrato as plano',
          'os.classificacao_encerramento',
          'os.servico_prestado'
          // 'plan.vlr_mensalidade'
        )
        ->orderBy('os.data_abertura', 'asc')
        ->get();
    }

    if ($request->tipo_pesquisa == 2) {
      $result = DB::connection('pgsql')->table('mk_os as  os')
        ->leftjoin('mk_os_classificacao_encerramento as classificacao', 'os.classificacao_encerramento', 'classificacao.codclassifenc')
        ->leftjoin('mk_contratos as contrato', 'os.cd_contrato', 'contrato.codcontrato')
        ->leftjoin('mk_pessoas as cliente', 'os.cliente', 'cliente.codpessoa')
        ->leftJoin('fr_usuario as u', 'os.operador_fech_tecnico', 'u.usr_codigo')
        ->leftJoin('fr_usuario as u2', 'os.tecnico_responsavel', 'u2.usr_codigo')
        ->leftJoin('mk_pessoas as consul', 'os.tecnico_responsavel', 'consul.codpessoa')
        ->leftJoin('mk_pessoas as tec', 'os.operador_fech_tecnico', 'tec.id_alternativo')
        ->leftJoin('mk_os_tipo as tip', 'os.tipo_os', 'tip.codostipo')
        ->leftJoin('mk_atendimento as atend', 'os.cd_atendimento', 'atend.codatendimento')
        // ->leftJoin('mk_conexoes as conex',  'cliente.codpessoa', 'conex.codcliente')
        // ->leftJoin('mk_contratos as cont', 'conex.contrato', 'cont.codcontrato' )
        ->whereBetween('os.data_fechamento', [$dtInicio, $dtFim])
        ->whereIn('os.operador_fech_tecnico', $tecnicos)
        // ->whereIn('os.tecnico_responsavel', $consultores)
        ->whereIn('tipo_os', $tipos)
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
          'contrato.vlr_renovacao as plano',
          'classificacao.classificacao as classificacao',
          'os.servico_prestado'
        )
        ->orderBy('os.data_fechamento', 'asc')
        ->get();
    }

    // return dd($result->count());
    $totalServicos = $result->count();
    $ordens = $result;
    return view('reports.relOs', compact('ordens', 'request', 'totalServicos'));
  }

  public function formContCanc()
  {
    return view('reports.formContCanc');
  }

  public function relContCanc(Request $request)
  {

    $dtInicio = Carbon::parse($request->dt_inicio)->format('Y-m-d');
    $dtFim = Carbon::parse($request->dt_fim)->format('Y-m-d');

    $result = DB::connection('pgsql')->table('mk_contratos as  c')
      ->join('mk_pessoas as cliente', 'c.cliente', 'cliente.codpessoa')
      ->leftJoin('mk_logradouros as log', 'cliente.codlogradouro', 'log.codlogradouro')
      ->leftJoin('mk_bairros as b', 'cliente.codbairro', 'b.codbairro')
      ->rightJoin('mk_motivo_cancelamento as motivo', 'c.motivo_cancelamento_2', 'motivo.codmotcancel')
      ->where('c.cancelado', 'S')
      ->whereBetween('c.dt_cancelamento', [$dtInicio, $dtFim])
      ->select
      ( 'c.codcontrato',
        'cliente.nome_razaosocial',
        'cliente.fone01',
        'cliente.fone02',
        'c.adesao',
        'c.dt_cancelamento',
        'c.motivo_cancelamento',
        'motivo.descricao_mot_cancel',
        'cliente.inativo',
        'c.vlr_renovacao',
        'log.logradouro',
        'cliente.numero',
        'b.bairro'
      )
      ->get();

    $contratos = $result;
    return view('reports.relContCanc', compact('contratos', 'request'));
  }


  public function relOs2(Request $request)
  {
    // Datas
    $dtInicio = Carbon::parse($request->dt_inicio)->format('Y-m-d 00:00:00');
    $dtFim = Carbon::parse($request->dt_fim)->format('Y-m-d 23:59:59');

    if ($request->tecnico_id) {
      $tecnicos[] = $request->tecnico_id;
    } else {
      $result = FrUsuario::select('usr_codigo')->get();

      foreach ($result as $r) {
        $tecnicos[] = $r->usr_codigo;
      }
    }

    // Tipos de OS
    if ($request->codostipo) {
      $tipos = $request->codostipo;
    } else {
      $result = MkOsTipo::select('codostipo')->get();
      foreach ($result as $r) {
        $tipos[] = $r->codostipo;
      }
    }

    //Consultores
    if ($request->consultor_id) {
      $consultores[] = $request->consultor_id;
    } else {
      $result = FrUsuario::select('usr_codigo')->get();
      foreach ($result as $r) {
        $consultores[] = $r->usr_codigo;
      }
    }

    // return dd($consultores);
    if ($request->tipo_pesquisa == 1) {
      $result = DB::connection('pgsql')->table('mk_os as  os')
        ->leftjoin('mk_os_classificacao_encerramento as classificacao', 'os.classificacao_encerramento', 'classificacao.codclassifenc')
        ->leftjoin('mk_contratos as contrato', 'os.cd_contrato', 'contrato.codcontrato')
        ->leftjoin('mk_pessoas as cliente', 'os.cliente', 'cliente.codpessoa')
        ->leftJoin('fr_usuario as u', 'os.operador_fech_tecnico', 'u.usr_codigo')
        ->leftJoin('fr_usuario as u2', 'os.tecnico_responsavel', 'u2.usr_codigo')
        ->leftJoin('mk_pessoas as consul', 'os.tecnico_responsavel', 'consul.codpessoa')
        ->leftJoin('mk_pessoas as tec', 'os.operador_fech_tecnico', 'tec.id_alternativo')
        ->leftJoin('mk_os_tipo as tip', 'os.tipo_os', 'tip.codostipo')
        ->leftJoin('mk_atendimento as atend', 'os.cd_atendimento', 'atend.codatendimento')
        ->leftJoin('mk_conexoes as conex',  'cliente.codpessoa', 'conex.codcliente')
        ->leftJoin('mk_contratos as cont', 'conex.contrato', 'cont.codcontrato' )
        ->whereBetween('os.data_abertura', [$dtInicio, $dtFim])
        ->whereIn('os.operador_fech_tecnico', $tecnicos)
        // ->whereIn('os.tecnico_responsavel', $consultores)
        ->whereIn('tipo_os', $tipos)
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
          'contrato.vlr_renovacao as plano',
          'cont.vlr_renovacao as plano2',
          'classificacao.classificacao as classificacao',
          'os.servico_prestado'
        )
        ->orderBy('os.data_abertura', 'asc')
        ->get();
    }

    if ($request->tipo_pesquisa == 2) {
      $result = DB::connection('pgsql')->table('mk_os as  os')
        ->leftjoin('mk_os_classificacao_encerramento as classificacao', 'os.classificacao_encerramento', 'classificacao.codclassifenc')
        ->leftjoin('mk_contratos as contrato', 'os.cd_contrato', 'contrato.codcontrato')
        ->leftjoin('mk_pessoas as cliente', 'os.cliente', 'cliente.codpessoa')
        ->leftJoin('fr_usuario as u', 'os.operador_fech_tecnico', 'u.usr_codigo')
        ->leftJoin('fr_usuario as u2', 'os.tecnico_responsavel', 'u2.usr_codigo')
        ->leftJoin('mk_pessoas as consul', 'os.tecnico_responsavel', 'consul.codpessoa')
        ->leftJoin('mk_pessoas as tec', 'os.operador_fech_tecnico', 'tec.id_alternativo')
        ->leftJoin('mk_os_tipo as tip', 'os.tipo_os', 'tip.codostipo')
        ->leftJoin('mk_atendimento as atend', 'os.cd_atendimento', 'atend.codatendimento')
        ->leftJoin('mk_conexoes as conex',  'cliente.codpessoa', 'conex.codcliente')
        ->leftJoin('mk_contratos as cont', 'conex.contrato', 'cont.codcontrato' )
        ->whereBetween('os.data_fechamento', [$dtInicio, $dtFim])
        ->whereIn('os.operador_fech_tecnico', $tecnicos)
        // ->whereIn('os.tecnico_responsavel', $consultores)
        ->whereIn('tipo_os', $tipos)
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
          'contrato.vlr_renovacao as plano',
          'cont.vlr_renovacao as plano2',
          'classificacao.classificacao as classificacao',
          'os.servico_prestado'
        )
        ->orderBy('os.data_fechamento', 'asc')
        ->get();
    }

    // return dd($result->count());
    $totalServicos = $result->count();
    $ordens = $result;
    return view('reports.relOs2', compact('ordens', 'request', 'totalServicos'));
  }





}



