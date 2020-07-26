<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Staff;
use Auth;
use Hash;

class StaffController extends Controller
{
    protected function update(Request $request){
        $method = $request->method();

        if($method == 'POST'){
            $newData = $request->all();
            $updateUser = User::find($newData['idProfile']);
            $updateUser->name = $newData['nomeProfile'];
            $updateUser->email = $newData['mailProfile'];
            $updateUser->save();

            return redirect('/configuracoes')->with('msg', 'Usuário atualizado!');
        }elseif ($method == 'GET') {
            return view('User.update');
        }else {
            return "Método não esperado. Deve ser POST ou GET";
        }
    }
    protected function delete(Request $request){
        $userId = $request['idUser'];
        $userDelete = User::find($userId);
        $userDelete->delete();

        return View::make('User.list');
    }
}
