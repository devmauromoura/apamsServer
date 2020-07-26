<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use ApamsServer\Mail\cadastroApi;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //CADASTRO MOBILE
    protected function register(Request $request)
    {
        $data = $request->all();
        if(User::where('email', $data['email'])->exists()){
            return response()->json(['msg'=>'E-mail ja cadastrado.'], 400);
        }
        else{
            $register = new User;
            $register->name = $data['name'];
            $register->email = $data['email'];
            $register->password = Hash::make($data['password']);
            $register->save();

            $userData = User::where('email', $data['email'])->first();

            //  Mail::to($data['email'])->send(new cadastroApi($userData));

           return response()->json([
            "message" => "Cadastro realizado com sucesso.",
            "status" => true
        ], 200);
        }
    }

    // LOGIN MOBILE
    protected function login(Request $request){
        if(Auth::guard('apilogin')->attempt(['email' => $request['email'], 'password' => $request['password']])){
            $user = Auth::guard('apilogin')->user();
            $token =  $user->createToken('token'.$user->id)->accessToken;
            return response()->json([
                "message" => "Login efetuado com sucesso",
                "status" => true,
                "token" => $token,
                "cellphone" => $user->cellphone
            ], 200);
        }else{
            
            return response()->json([
                "message" => "Falha, verifique suas credenciais e tente novamente.",
                "status" => false
            ], 401);
        }
    }

    // ATUALIZAÇÃO MOBILE
    protected function updateUser(Request $request){
        $newData = $request->all();
        $updateUser = User::find(Auth::user()->id);
        $updateUser->name = $request['name'];
        $updateUser->email = $request['email'];
        $updateUser->password = Hash::make($request['password']);
        $updateUser->cellphone = $request['cellphone'];
        // criar processo para imagem  $request['avatarb64'];
        $updateUser->save();

        return response()->json([
            "message" => "Perfil atualizado",
            "status" => true
        ], 200);
    }

    // DADOS PERFIL MOBILE
    public function showProfile(){
        $dataUser = Auth::user()->only(['name','email','active','cellphone', 'avatar']);
        return response()->json([
            "message" => "Sucesso.",
            "status" => true,
            "data" => $dataUser
        ], 200);
    }

    // ATIVAR CONTA
    protected function activeaccount($id){
        $user = User::find($id);
        $user->active = 1;
        $user->save();

        //Enviar e-mail de confirmação.
        
        return response()->json([
            "message" => "Cadastro ativado.",
            "status" => true
        ], 200);
    }

    protected function logout(){
        $user =  Auth::guard('api')->user()->token();  
        $user->revoke();

        return response()->json([
            "message" => "Logout efetuado.",
            "status" => true
        ], 200);
    }
}
