<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use ApamsServer\Sponsors;
use ApamsServer\User;
Use Auth;
use Illuminate\Support\Facades\View;

class homeController extends Controller
{
    public function show(){
        $totalCat = Animals::where('type','Gato')->count();
        $totalDog = Animals::where('type','Cachorro')->count();
        $totalAdopted = Animals::where('adopted','2')->count();
        $totalNoAdopted = Animals::where('adopted','<=','2')->count();
        $totalSponsors = Sponsors::count();
        $totalUsers = User::count();
        $nameUserAuth = Auth::user()->name;
        
        return view('home')->with(compact('totalCat'))->with(compact('totalDog'))->with(compact('totalAdopted'))->with(compact('totalNoAdopted'))->with(compact('totalSponsors'))->with(compact('totalUsers'))->with(compact('nameUserAuth'));
    }
}
