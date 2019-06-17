<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use Auth;
class AnimalsController extends Controller
{

        //###################### FUNCTIONS 4 WEB ROUTES ######################

    protected function showWeb(){
        $animals = Animals::all();

        return View::make('animais', compact('animais'));
    }

    protected function registerWeb(Request $request){
            $dataAnimal = $request->all();
            $newAnimal = new Animals;
            $newAnimal->name = $dataAnimal['name'];
            $newAnimal->size = $dataAnimal['size'];
            $newAnimal->type = $dataAnimal['type'];
            $newAnimal->adopted = $dataAnimal['adopted'];
            $newAnimal->description = $dataAnimal['description'];
            $newAnimal->save();
            return redirect()->back();
    }

    protected function updateWeb(Request $request){
        $method = $request->method();

        if($request->isMethod('post')){
            $animalUpdate = $request->all();
            $dataUpdate = Animals::find($animalUpdate['id']);
            $dataUpdate->name = $animalUpdate['name'];
            $dataUpdate->size = $animalUpdate['size'];
            $dataUpdate->type = $animalUpdate['type'];
            $dataUpdate->description = $animalUpdate['description'];
            $dataUpdate->adopted = $animalUpdate['adopted'];
            $dataUpdate->save();

            return redirect('configuracoes');
        }elseif($request->isMethod('get')){
            return View::make('Animals.list');
        }
    }


    protected function deleteWeb(Request $request){
        $animalID = $request['id'];
        $animalDelete = Animals::find($animalID);
        $animalDelete->delete();

        return "Animal Removido!";
    }


}
