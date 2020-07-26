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
use DB;

class AnimalsController extends Controller
{
    public function show(Request $request){
        $params = $request->all();
    
        $Animals;
        if(count($params) == 0){
            $Animals = Animals::all();
        }else{
            $query = "";
            if(isset($params['name'])){
                $query .= "name LIKE '%".$params['name']."%' and ";
            }
            if(isset($params['type'])){
                $query .= "type = '".$params['type']."' and ";
            }
            if(isset($params['size'])){
                $query .= "size = '".$params['size']."' and ";
            }
            if(isset($params['sex'])){
                $query .= "sex = '".$params['sex']."' and ";
            }
        
            $query = substr($query, 0, -5); // remove o ultimo 'and'
            $Animals = DB::select(DB::raw('select * from apams.animals where '.$query));
        }

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
