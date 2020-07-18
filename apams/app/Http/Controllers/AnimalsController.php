<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Storage;

class AnimalsController extends Controller
{
    //Funções para Routes Web

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

            $file = $request->file('image');
            $path = $file->path(); #Pega o caminho temporario da img
            $extension = $file->extension(); # Peaga a extensão do arquivo
            $converted = Str::kebab($file->getClientOriginalName());
            $url = $request->file('image')->store('animais');
            $newAnimal->avatarUrl = 'http://localhost:8080/storage/'.$url;
            $newAnimal->save();

            return redirect()->back()->with('msg', 'Animal Cadastrado!');


    }

    protected function updateWeb(Request $request){
        $method = $request->method();

        if($request->isMethod('post')){
            $animalUpdate = $request->all();
            $dataUpdate = Animals::find($animalUpdate['idAnimal']);
            $dataUpdate->name = $animalUpdate['nameAnimal'];
            $dataUpdate->size = $animalUpdate['porteAnimal'];
            $dataUpdate->type = $animalUpdate['typeAnimal'];
            $dataUpdate->description = $animalUpdate['descriptionAnimal'];
            $dataUpdate->adopted = $animalUpdate['adoptedAnimal'];

            $file = $request->file('image');
            $path = $file->path(); #Pega o caminho temporario da img
            $extension = $file->extension(); # Peaga a extensão do arquivo
            $converted = Str::kebab($file->getClientOriginalName());

            $url = $request->file('image')->store('animais');
            $dataUpdate->avatarUrl = 'http://localhost:8080/storage/'.$url;
            $dataUpdate->save();

            return redirect('configuracoes')->with('msg', 'Animal atualizado com sucesso!');
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
