<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Sponsors;
use Illuminate\Support\Facades\View;

class SponsorsController extends Controller
{

    public function show(){
        return View::make('sponsor');
    }

    protected function register(Request $request){
        $sponsorData = $request->all();
        $registerData = new Sponsors;
        $registerData->name = $sponsorData['name'];
        $registerData->logoTypeUrl = $sponsorData['logoTypeUrl'];
        $registerData->save();

        return redirect('/patrocinadores');
    }
}
