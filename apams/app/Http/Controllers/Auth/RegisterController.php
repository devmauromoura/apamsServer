<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\User;
use ApamsServer\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use ApamsServer\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function createView(){
        return View::make('Auth\register');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \ApamsServer\User
     */
    protected function createWeb(RegisterUser $data)
    {   
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['return'=>'Email ja cadastrado'],403);
        }
        else{
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = Hash::make($data['password']);
            //$register->cellphone = $data['cellphone']; //Inserir checagem de telefone ao logar. 
            $register->typeAccount = $data['typeAccount'];
            $register->save();

            return response()->json(['return'=>'Cadastro realizado com sucesso. Ative seu cadastro pelo link encaminhado no email.'],201);
        }
    }

    protected function createApi(RegisterUser $data)
    {   
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['return'=>'Email ja cadastrado'],403);
        }
        else{
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = Hash::make($data['password']);
            //$register->cellphone = $data['cellphone']; //Inserir checagem de telefone ao logar. 
            $register->typeAccount = 0;
            $register->save();

            return response()->json(['return'=>'Cadastro realizado com sucesso. Ative seu cadastro pelo link encaminhado no email.'],201);
        }
    }

    protected function activeaccount($id){
        $user = User::find($id);
        $user->activeAccount = 1; 
        $user->save();

        //Enviar e-mail de confirmação.

        return response()->json(['return'=>'Cadastro ativado com sucesso.'], 200);
    }

}
