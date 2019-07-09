<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use ApamsServer\User;
use ApamsServer\Sponsors;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class ConfiguracoesController extends Controller

{

    public function access(){
        
        $tokenOr = User::where('email','devmauromoura@gmail.com')->get();
        $result =  json_decode($tokenOr);
        $tokenfn = $result[0]->refresh_token;

        $access = new Client();
        $responseAccess = $access->post('https://www.googleapis.com/oauth2/v4/token', [
            'form_params' => [
                'refresh_token' => $tokenfn,
                'client_id' => '1006479685201-bji1q1egg2dcqonnu0c14jkbghuokbb5.apps.googleusercontent.com',
                'client_secret' => 'TJPAWTUbMobioLBwsqCIrnAR',
                'grant_type' => 'refresh_token',
            ],
        ]);

        $responseAccess = json_decode($responseAccess->getBody(), true);

        $up = User::find(2);
        $up->access_token = $responseAccess['access_token'];
        $up->save();

    }


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
        //$this->access();
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
