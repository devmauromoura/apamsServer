<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\User;
use Auth;
use Hash;

class UserController extends Controller
{
    protected function update(Request $request){
        $method = $request->method();

        if($method == 'POST'){
            $newData = $request->all();
            $updateUser = User::find($newData['idProfile']);
            $updateUser->name = $newData['nomeProfile'];
            $updateUser->email = $newData['mailProfile'];
            $updateUser->cellphone = $newData['celProfile'];
            $updateUser->typeAccount = $newData['tipoConta'];
            $updateUser->activeAccount = $newData['statusProfile'];
            $updateUser->save();

            return redirect('/configuracoes')->with('msg', 'Usuário atualizado!');
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

        return response()->json(['Cadastro atualizado com sucesso'], 200);
        //return response()->json(['return' => Auth::user()->id]);
    }

    protected function delete(Request $request){
        $userId = $request['idUser'];
        $userDelete = User::find($userId);
        $userDelete->delete();

        return View::make('User.list');
    }
        // Rotas APi
    public function showProfile(){
        $dataUser = Auth::user()->only(['name','email','activeAccount','cellphone']);
        return response()->json(['status' => 'success', 'msg' => $dataUser], 200);
    }
}
