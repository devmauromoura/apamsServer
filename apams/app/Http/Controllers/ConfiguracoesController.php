<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use ApamsServer\User;
use ApamsServer\Sponsors;
use Auth;
use GuzzleHttp\Client;

class ConfiguracoesController extends Controller
{
    public function convert(){

        $ac = Animals::count();
        for($ap = 1; $ap  <= $ac; $ap++){
            $token = Auth::user()->access_token;
            $client = new Client();
            $an = Animals::find($ap);
            $id = $an["avatarId"];
            $response = $client->get('https://photoslibrary.googleapis.com/v1/mediaItems/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Content-type' => 'application/json',
                ],
            ]);
    
            $response = json_decode($response->getBody(), true);
            $url = $response['baseUrl'];
            $an->avatarUrl = $url;
            $an->save();
        } 
    }

    public function show(){

        //$this->convert();

        $animal = Animals::all();
        $animalCount = Animals::count();
        $users = User::all();
        $usersCount = User::count();
        $nameUserAuth = Auth::user()->name;
        $sponsors = Sponsors::all();


        return view('config')->with(compact('animal'))->with(compact('animalCount'))->with(compact('users'))->with(compact('usersCount'))->with(compact('nameUserAuth'))->with(compact('sponsors'));

    }    
}
