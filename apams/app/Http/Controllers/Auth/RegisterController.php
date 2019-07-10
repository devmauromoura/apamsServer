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
use Illuminate\Support\Facades\Mail;
use ApamsServer\Mail\cadastroApi;

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
        //$this->middleware('guest');
    }

    public function register(Request $request){
        $data = $request->all();
        $method = $request->method();

        if($method == 'POST'){
            $validatedData = Validator::make($request->all(), [
                'nameProfile' => 'required',
                'emailProfile' => 'required',
                'passProfile' => 'required',
                'typeAccount' => 'required',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()->with('msg', 'Envie os dados corretamente!');
            }
            else {
                if(User::where('email', $data['emailProfile'])->exists()){
                    return redirect()->back()->with('msg', 'E-mail já cadastrado!');
                }
                else {
                    $registerUser = new User;
                    $registerUser->name = $data['nameProfile'];
                    $registerUser->email = $data['emailProfile'];
                    $registerUser->password = Hash::make($data['passProfile']);
                    $registerUser->typeAccount = $data['typeAccount'];
                    $registerUser->save();

                    return redirect()->back()->with('msg', 'Usuário cadastrado!');
                }
            }
        }
        elseif ($method == 'GET') {
            return view('Auth.register');
        }
        else{
            return "Method invalido!";
        }
    }

    protected function activeaccount($id){
        $user = User::find($id);
        $user->activeAccount = 1;
        $user->save();

        //Enviar e-mail de confirmação.

        return response()->json(['return'=>'Cadastro ativado com sucesso.'], 200);
    }

    protected function registerApi(Request $data)
    {
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['return'=>'usuario ja cadastrado'],403);
        }
        else{
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = Hash::make($data['password']);
            $register->typeAccount = 0;
            $register->save();

            $userData = User::where('email', $data['email'])->first();

           Mail::to($data['email'])->send(new cadastroApi($userData));

           return response()->json(['cadastro realizado com sucesso'],200);
        }
    }
}
