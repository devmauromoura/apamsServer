<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use ApamsServer\User;
use ApamsServer\Sponsors;
use Auth;

class ConfiguracoesController extends Controller
{
    public function show(){
        $animal = Animals::all();
        $animalCount = Animals::count();
        $users = User::all();
        $usersCount = User::count();
        $nameUserAuth = Auth::user()->name;
        $sponsors = Sponsors::all();

        return view('config')->with(compact('animal'))->with(compact('animalCount'))->with(compact('users'))->with(compact('usersCount'))->with(compact('nameUserAuth'))->with(compact('sponsors'));
    }    
}
