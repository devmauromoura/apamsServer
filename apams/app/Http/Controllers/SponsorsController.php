<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Sponsors;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class SponsorsController extends Controller
{
    protected function register(Request $request){
        $sponsorData = $request->all();
        $registerData = new Sponsors;
        $registerData->name = $sponsorData['namePatrocinio'];
        $registerData->email = $sponsorData['emailPatrocinio'];
        $registerData->cellphone = $sponsorData['celPatrocinio'];
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
        $registerData->logoTypeUrl = $urlSave;//$sponsorData['logoTypeUrl'];
        $registerData->save();

        return redirect('/configuracoes')->with('msg', 'Patrocinador Cadastrado!');
    }

    protected function update(Request $request){
        $sponsorData = $request->all();
        $dataUpdate = Sponsors::find($request['idPatrocinador']);
        $dataUpdate->name = $request['nomePatrocinador'];
        $dataUpdate->email = $request['mailPatrocinador'];
        $dataUpdate->cellphone = $request['celPatrocinador'];
        $dataUpdate->save();

        return redirect('configuracoes')->with('msg', 'Patrocinador atualizado!');

    }
}
