<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\Animals;
use ApamsServer\AnimalsGallery;
use Illuminate\Support\Facades\Mail;
use ApamsServer\Mail\SolicitacaoAdocao;
use ApamsServer\Settings;
use Auth;

class AnimalsController extends Controller
{
    public function show(){
        $Animals = Animals::all();

        return response()->json([
            "message" => "Sucesso.",
            "status" => true,
            "data" => $Animals
        ], 200);
    }

    protected function showAnimal($id){
        $Animal = Animals::find($id);

        return response()->json([
            "message" => "Sucesso.",
            "status" => true,
            "data" => $Animal
        ], 200);
    }

    public function gallery($id){
        $Gallery = AnimalsGallery::where('animal_id', $id)->get(['id', 'image_url', 'description', 'created_at']);

        return response()->json([
            "message" => "Sucesso.",
            "status" => true,
            "data" => $Gallery
        ], 200);
    }

    public function adopt($id){
        // Email para onde será enviado a solicitação de adoção.
        $email = Settings::first();

        // Dados no animal a ser adotado e do usuário que solicitou a adoção;
        $animal = Animals::find($id)->only(['id', 'name', 'type']);
        $user = Auth::user()->only(['id', 'name', 'email', 'cellphone', 'created_at']);

        if(!$user['cellphone'] || strlen($user['cellphone']) < 8){
            return response()->json([
                "message" => "Para solicitar a adoção é necessário cadastrar seu celular no perfil.",
                "status" => false,
            ], 400);
        }else{
             //Mail::to($email->adopt_mail)->send(new SolicitacaoAdocao());

            return response()->json([
                "message" => "Adoção requirida.",
                "status" => true,
            ], 200);
        }
       
    }

}
