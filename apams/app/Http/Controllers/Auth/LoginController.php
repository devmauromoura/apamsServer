<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use ApamsServer\User;
use ApamsServer\Staff;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        //        $this->middleware('guest')->except('logout');
    }

    public function sair()
    {
        auth()->logout();

        return redirect('/');
    }


    public function index(){
        if(Auth::check()){
            return redirect('home');
        }else{
            return View::make('login');
        }
    }

    protected function login(Request $request){
                
                if(Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])){
                    return redirect('home');
                }else{
                   return redirect('/')->with('error', 'Verifique suas credenciais!');
                    }
    }
}
