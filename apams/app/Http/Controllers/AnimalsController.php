<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use ApamsServer\AnimalsGallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Storage;

class AnimalsController extends Controller
{

// Rotas Front
    public function index()
    {
        $nameUserAuth = Auth::user()->name;
        return view('animais/animais')->with('nameUserAuth',$nameUserAuth);
    }

    public function getDados()
    {
        $animals = Animals::all();
        return response()->json(['data' => $animals]);
    }

    public function formulario($id=null)
    {

        $data = [];

        if($id)
        {
            $animal = new Animals;
            $animal = $animal::find($id);
            $galeria = new AnimalsGallery;
            $galeria = $galeria::where('animal_id', '=', $id)->get();

            $data['animal'] = $animal;
            $data['galeria'] = $galeria;
        }

        return view('animais/animais_formulario')->with('dados',$data);
    }

    public function salvar(Request $request)
    {
        if(isset($request['images_avatar'])){
            try {
                $extavatar = $request->file('images_avatar')[0]->extension();
                $dataavatar = date('d-m-Y_H-i-s');
                $nomeavatar = kebab_case($request['nome']);
                $nomeimgavatar = "avatar_{$nomeavatar}_{$dataavatar}.{$extavatar}";
    
                $saveStorageAvatar = $request->file('images_avatar')[0]->storeAs('animal_avatar',$nomeimgavatar); 
            } catch (\Throwable $th) {
                return redirect('animais')->with('danger', 'Erro ao cadastrar o animal! [IMG AVATAR]');
            }
        }
        

        try {
            $newAnimal = new Animals;
            $newAnimal->name = $request['nome'];
            $newAnimal->size = $request['porte'];
            $newAnimal->type = $request['tipo'];
            $newAnimal->weight = $request['peso'];
            $newAnimal->age = $request['idade'];
            $newAnimal->sex = $request['sexo'];
            $newAnimal->adopted = $request['status'];
            $newAnimal->history = $request['historia'];
            if(isset($request['images_avatar'])){
                $newAnimal->avatar_url = $nomeimgavatar;
            }
            $newAnimal->save();

            $uid = $newAnimal->id;
    
        } catch (\Throwable $th) {
            return redirect('animais')->with('danger', 'Erro ao cadastrar o animal! [BD]');
        }

        if(isset($request['images_gallery'])){
            try {
                foreach ($request['images_gallery'] as $key => $img) {
    
                    $ext = $request->file('images_gallery')[$key]->extension();
                    $data = date('d-m-Y_H-i-s');
                    $nome = kebab_case($request['nome']);
                    $nomeimg = "gallery{$key}_{$nome}_{$data}.{$ext}";
        
                    $saveStorage = $request->file('images_gallery')[$key]->storeAs('animais_gallery',$nomeimg);
    
                    $AnimalGallery = new AnimalsGallery;
                    $AnimalGallery->image_url = $nomeimg;
                    $AnimalGallery->animal_id = $uid;
                    $AnimalGallery->save();
                }
            } catch (\Throwable $th) {
                return redirect('animais')->with('danger', 'Erro ao cadastrar o animal! [IMG GALLERY]');
            }
        }
        
        return redirect('animais')->with('success', 'Animal cadastrado com sucesso!');
    }

    public function editar(Request $request, $id)
    {
        if(isset($request['images_avatar'])){
            try {
                $extavatar = $request->file('images_avatar')[0]->extension();
                $dataavatar = date('d-m-Y_H-i-s');
                $nomeavatar = kebab_case($request['nome']);
                $nomeimgavatar = "avatar_{$nomeavatar}_{$dataavatar}.{$extavatar}";
    
                $saveStorageAvatar = $request->file('images_avatar')[0]->storeAs('animal_avatar',$nomeimgavatar); 
            } catch (\Throwable $th) {
                return redirect('animais')->with('danger', 'Erro ao editar o animal! [IMG AVATAR]');
            }
        }

        try {
            $newAnimal = new Animals;
            $newAnimal = $newAnimal::find($id);
            $newAnimal->name = $request['nome'];
            $newAnimal->size = $request['porte'];
            $newAnimal->type = $request['tipo'];
            $newAnimal->weight = $request['peso'];
            $newAnimal->age = $request['idade'];
            $newAnimal->sex = $request['sexo'];
            $newAnimal->adopted = $request['status'];
            $newAnimal->history = $request['historia'];
            if(isset($request['images_avatar'])){
                $newAnimal->avatar_url = $nomeimgavatar;
            }elseif (!isset($request['images_avatar']) && !isset($request['preloaded_avatar'])) {
                $newAnimal->avatar_url = "";
            }
            $newAnimal->save();

            $uid = $newAnimal->id;
        } catch (\Throwable $th) {
            return redirect('animais')->with('danger', 'Erro ao editar o animal! [BD]');
        }

        if(!isset($request['images_gallery']) && !isset($request['preloaded_gallery'])) {
            $verifyAnimalGallery = new AnimalsGallery;
            $verifyAnimalID = $verifyAnimalGallery::where('animal_id', '=', $id)->delete();
        }

        if(isset($request['preloaded_gallery'])){

            try {

                $AnimalGallery = new AnimalsGallery;
                $AnimalID = $AnimalGallery::where('animal_id', '=', $id)->get();

                $arrDelete = [];

                foreach ($AnimalID as $arrbd) {
                    if(!in_array($arrbd->id, $request['preloaded_gallery'])){
                        $arrDelete[] = $arrbd->id;
                    }
                }
                
                $Animalremovelocal = $AnimalGallery::whereIn('id', $arrDelete)->get();

                $Animalremove = $AnimalGallery::whereIn('id', $arrDelete)->delete();

                foreach ($Animalremovelocal as $arrdel) {
                    Storage::delete('animais_gallery/'.$arrdel->galleryUrl);
                }

            } catch (\Throwable $th) {
                return redirect('animais')->with('danger', 'Erro ao editar o animal! [IMG GALLERY]');
            }

        }

        if(isset($request['images_gallery'])){
            try {
                foreach ($request['images_gallery'] as $key => $img) {
    
                    $ext = $request->file('images_gallery')[$key]->extension();
                    $data = date('d-m-Y_H-i-s');
                    $nome = kebab_case($request['nome']);
                    $nomeimg = "gallery{$key}_{$nome}_{$data}.{$ext}";
        
                    $saveStorage = $request->file('images_gallery')[$key]->storeAs('animais_gallery',$nomeimg);
    
                    $AnimalGallery = new AnimalsGallery;
                    $AnimalGallery->image_url = $nomeimg;
                    $AnimalGallery->animal_id = $uid;
                    $AnimalGallery->save();
                }
            } catch (\Throwable $th) {
                return redirect('animais')->with('danger', 'Erro ao editar o animal! [IMG GALLERY]');
            }
        }

        return redirect('animais')->with('success', 'Animal editado com sucesso!');
    }

    protected function remover(Request $request, $id)
    {
        try {

            $AnimalGallery = new AnimalsGallery;
            $AnimalGalleryRemove = $AnimalGallery::where('animal_id', '=', $id)->get();
    
            foreach ($AnimalGalleryRemove as $imgdel) {
                Storage::delete('animais_gallery/'.$imgdel->galleryUrl);
            }
    
            foreach ($AnimalGalleryRemove as $bddel) {
                $AnimalGallery::find($bddel->id)->delete();
            }

        } catch (\Throwable $th) {
            return redirect('animais')->with('danger', 'Erro ao remover o animal! [IMG]');
        }

        try {
            $Animal = new Animals;
            $Animal = $Animal::find($id);
            $Animal->delete();
        } catch (\Throwable $th) {
            return redirect('animais')->with('danger', 'Erro ao remover o animal! [BD]');
        }

        return redirect('animais')->with('success', 'Animal removido com sucesso!');
    }
// Rotas Front

// Rotas API

    public function show(){
        $dataAnimals = Animals::all();

        return response()->json(['return'=> $dataAnimals], 200);
    }

    protected function showAnimal($id){
        $dataAnimal = Animals::find($id);
        
        return response()->json(['return'=> $dataAnimal], 200);
    }

// Rotas API

}
