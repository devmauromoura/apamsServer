<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\User;
use Auth;
use Hash;

class UserController extends Controller
{
    protected function show(){
        return User::all();
    }

    protected function update(Request $request){
        $method = $request->method();

        if($method == 'POST'){
            $newData = $request->all();
            $updateUser = User::find($request['idUser']);
            $updateUser->name = $request['name'];
            $updateUser->email = $request['email'];
            $updateUser->password = Hash::make($request['password']);
            $updateUser->cellphone = $request['cellphone'];
            $updateUser->save();

            return "update realizado";
        }elseif ($method == 'GET') {
            return view('User.update');
        }else {
            return "Método não esperado. Deve ser POST ou GET";
        }
    }


    protected function updateUser(Request $request){
        $newData = $request->all();
        $updateUser = User::find(Auth::user()->id);
        $updateUser->name = $request['name'];
        $updateUser->email = $request['email'];
        $updateUser->password = Hash::make($request['password']);
        $updateUser->cellphone = $request['cellphone'];
        $updateUser->save();

        return response()->json(['return'=>'Cadastro atualizado com sucesso'], 200);
        //return response()->json(['return' => Auth::user()->id]);
    }
}
