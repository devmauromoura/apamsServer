<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Auth;

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

            $photos = $request->user()->photos();
            $file = $request->file('image');
            $path = $file->path(); #Pega o caminho temporario da img
            $extension = $file->extension(); # Peaga a extensão do arquivo
            $converted = Str::kebab($file->getClientOriginalName());       
            $uploadToken = $photos->upload($converted, fopen($path, 'r'));
            $result = $photos->batchCreate([$uploadToken]);         
            $dadosUpload = $result->newMediaItemResults['0']->mediaItem->id;
            $media = $request->user()->photos()->media($dadosUpload);
            $baseUrl = $media;
            $urlSave = $baseUrl->baseUrl;
            
            //dd($urlSave);

            $newAnimal->avatarUrl = $urlSave; 
            
            $newAnimal->save();
            
            return redirect()->back();
            

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

            $photos = $request->user()->photos();
            $file = $request->file('image');
            $path = $file->path(); #Pega o caminho temporario da img
            $extension = $file->extension(); # Peaga a extensão do arquivo
            $converted = Str::kebab($file->getClientOriginalName());       
            $uploadToken = $photos->upload($converted, fopen($path, 'r'));
            $result = $photos->batchCreate([$uploadToken]);            
            $dadosUpload = $result->newMediaItemResults['0']->mediaItem->id;
            $media = $request->user()->photos()->media($dadosUpload);
            $baseUrl = $media;
            $urlSave = $baseUrl->baseUrl;
            $dataUpdate->avatarUrl = $urlSave;
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
