<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\User;
use ApamsServer\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \ApamsServer\User
     */
    protected function create(Request $data)
    {   
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['return'=>'email ja cadastrado'],403);
        }
        else{
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            //$register->password = Hash::make($data['password']); //Inserir cadastramento de senha após confirmação no e-mail. 
            //$register->cellphone = $data['cellphone']; //Inserir checagem de telefone ao logar. 
            $register->typeAccount = $data['typeAccount'];
            $register->save();

            return response()->json(['return'=>'cadastro realizado com sucesso'],201);
        }
    }

    protected function savepass(Request $request, $id){
        $user = User::find($id);
        $user->password = Hash::make($request['password']);
        $user->save();

        return response()->json(['return'=>'senha cadastrada com sucesso'], 200);
    }

}
