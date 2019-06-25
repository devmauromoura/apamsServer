<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Sponsors;
use Illuminate\Support\Facades\View;

class SponsorsController extends Controller
{
    protected function register(Request $request){
        $sponsorData = $request->all();
        $registerData = new Sponsors;
        $registerData->name = $sponsorData['namePatrocinio'];
        $registerData->email = $sponsorData['emailPatrocinio'];
        $registerData->cellphone = $sponsorData['celPatrocinio'];
        $registerData->logoTypeUrl = 'teste';//$sponsorData['logoTypeUrl'];
        $registerData->save();

        return redirect('/configuracoes');
    }

    protected function update(Request $request){
        $sponsorData = $request->all();
        $dataUpdate = Sponsors::find($request['idPatrocinador'];);
        $dataUpdate->name = $request['nomePatrocinador'];
        $dataUpdate->email = $request['mailPatrocinador'];
        $dataUpdate->cellphone = $request['celPatrocinador'];
        $dataUpdate->save();

        return redirect('configuracoes');

    }
}
