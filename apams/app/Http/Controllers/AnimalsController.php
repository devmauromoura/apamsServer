<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use Auth;
class AnimalsController extends Controller
{
    protected function show(){
        return response()->json(['return'=> Animals::all()], 200);
    }

    protected function register(Request $request){
        if (Auth::user()->activeAccount == 1){
            $animalData = $request->all();
            
            $newAnimal = new Animals;
            $newAnimal->name = $request['name'];
            $newAnimal->size = $request['size'];
            $newAnimal->type = $request['type'];
            $newAnimal->description = $request['description'];
            $newAnimal->save();

            return response()->json(['return'=>'Animal cadastrado com sucesso.'], 201);
        }else{
            return response()->json(['return'=>'Para registrar animais, seu cadastro deve estar ativo. Cheque a confirmação em seu email'], 401);
        }
    }

    protected function update(Request $request){
        if (Auth::user()->activeAccount == 1){
            $updateData = $request->all();
            
            $animalUpdate = Animals::find($updateData['id']);
            $animalUpdate->name = $updateData['name'];
            $animalUpdate->size = $updateData['size'];
            $animalUpdate->type = $updateData['type'];
            $animalUpdate->description = $updateData['description'];
            $animalUpdate->save();

            return response()->json(['return'=>'Registro de animal atualizado com sucesso.'], 200);
        }else {
            return response()->json(['return'=>'Para atualizar os dados dos animais, seu cadastro deve estar ativo. Cheque a confirmação em seu email'], 401);
        }
    }

    protected function delete(Request $request){
        if (Auth::user()->activeAccount == 1){
            $animalDelete = Animals::find($request['id']);
            $animalDelete->delete();

            return response()->json(['return'=>'Registro de animal removido com sucesso.'], 200);
        }else{
            return response()->json(['return'=>'Para remover os animais, seu cadastro deve estar ativo. Cheque a confirmação em seu email'], 401);
        }
    }
}
