<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Validators\UserValidator;
use App\Repositories\UserRepository;
use App\Repositories\SolicitacaoRepository;
use App\Repositories\TipoMidiaRepository;
use App\Repositories\EscalaRepository;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;
use Auth;

class DashboardController extends Controller
{

    protected $repository;
    protected $solicitacaoRepository;
    protected $tipoMidiaRepository;
    protected $escalaRepository;


    public function __construct(UserRepository $repository, SolicitacaoRepository $solicitacaoRepository, EscalaRepository $escalaRepository, TipoMidiaRepository $tipoMidiaRepository)
    {
        $this->repository = $repository;
        $this->escalaRepository = $escalaRepository;
        $this->solicitacaoRepository = $solicitacaoRepository;
        $this->tipoMidiaRepository = $tipoMidiaRepository;
    }
    public function login(){
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(){
        return view('auth.register');
    }

    public function dashboard(){

        $solicitacaos = $this->solicitacaoRepository->scopeQuery(function ($query) {
          return $query
            ->orderBy('created_at', 'desc');
        })->get();

        $atendimentosDiario = $solicitacaos->where('dt_agendamento','=' ,Carbon::now()->format('Y-m-d 00:00:00'));

        $atendimentos = $atendimentosDiario->count();
        $andamento = count($atendimentosDiario->where('status_solicitacao_id','=' ,2));
        $concluidos = count($atendimentosDiario->where('status_solicitacao_id','=' , 3));

        $pendentes = count($solicitacaos
                            ->where('dt_agendamento','<=' ,Carbon::now()->format('Y-m-d 00:00:00'))
                            ->where('dt_conclusao', null));


        return view('dashboard.v1', compact('solicitacaos', 'atendimentos','andamento', 'concluidos', 'pendentes'));
    }

    public function auth(Request $request)
    {

        $data = [
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        ];

        try {
            if(env('PASSWORD_HASH')){
                Auth::attempt($data, false);
            }else{
                $user = $this->repository->findWhere(['email'=>$request->get('email') ])->first();

                if(!$user){
                    throw new Exception("Email inválido");
                }

                if($user->password != $request->get('password')){
                    throw new Exception("Senha inválida");
                }

                Auth::login($user);
                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {
            //throw $th;
            return Redirect()->back()->with(['message' => 'The Message']);

        }
    }
}
