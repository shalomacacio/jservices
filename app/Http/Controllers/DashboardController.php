<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Validators\UserValidator;
use App\Repositories\UserRepository;
use App\Repositories\SolicitacaoRepository;
use App\Repositories\TecnicoRepository;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Carbon;
use Auth;

class DashboardController extends Controller
{

    protected $repository;
    protected $solicitacaoRepository;
    protected $tecnicoRepository;


    public function __construct(UserRepository $repository, SolicitacaoRepository $solicitacaoRepository, TecnicoRepository $tecnicoRepository)
    {
        $this->repository = $repository;
        $this->tecnicoRepository = $tecnicoRepository;
        $this->solicitacaoRepository = $solicitacaoRepository;
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
        $tecnicos =  $this->tecnicoRepository->all();
        $solicitacaos = $this->solicitacaoRepository->all();
        $abertos = $solicitacaos->where('status_solicitacao_id', '1'); //1 - aberto
        $andamento = $solicitacaos->where('status_solicitacao_id', '2'); //2 - andamentos
        $pendentes = $solicitacaos->where('status_solicitacao_id', '5'); //5 - pendente
        $concluidos = $solicitacaos->where('status_solicitacao_id', '3'); //3 - concluido

        return view('dashboard.v1', compact('tecnicos', 'solicitacaos', 'abertos','andamento', 'pendentes', 'concluidos'));
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
