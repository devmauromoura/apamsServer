<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use ApamsServer\User;
use Illuminate\Support\Facades\View;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        if(Auth::check()){
            return redirect('home');
        }else{
            return View::make('Auth\login');    
        }
    }

    protected function login(Request $request){
    
                $registerdate = $request->all();
                if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
                    return "Logado";
                }else{
                    return "Usuario/Senha incorretos, tente novamente";
                    }
    }

    protected function loginapi(Request $request){
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            $user = Auth::user();
            $token['token'] =  $user->createToken('token'.$user->id)->accessToken; 
            
            return response()->json(['return' => 'Login efetuado com sucesso', 'token' => $token,'cellphone' => $user->cellphone], 200);
        }else{
            return response()->json(['return' => 'Falha, verifique suas credenciais e tente novamente.'], 401);
            //return response()->json(['return'=> $request->all()]);
        }
    }
}
