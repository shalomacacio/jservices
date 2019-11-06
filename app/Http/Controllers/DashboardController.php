<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Validators\UserValidator;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Auth;

class DashboardController extends Controller
{

    protected $repository;
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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
        return view('dashboard.v1');
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
