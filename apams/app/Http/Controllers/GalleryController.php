<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function enviar(Request $request){
        if ($request->hasFile('imagemUp')) {
            if($request->file('imagemUp')->isValid()){    
                $data = $request['imagemUp']; #Pega somento o arquivo do array
                $path = $data->path(); #Pega o caminho temporario da img
                $extension = $data->extension(); # Peaga a extensão do arquivo
                $converted = Str::kebab($data->getClientOriginalName());

                $enviar = $data->storeAs('images', $converted,'google');

                return "Sera que deu?";

            }
            else {
                return "Imagem não é válida";
            }
        }
        else {
            return "Não há foto carregada";
        }
    }


}
