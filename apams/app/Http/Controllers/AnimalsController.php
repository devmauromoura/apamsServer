<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Animals;
use Auth;
class AnimalsController extends Controller
{
    
        //###################### FUNCTIONS 4 WEB ROUTES ######################
    
    protected function showWeb(){
        $animals = Animals::all();
        
        return View::make('animais', compact('animais'));
    }
    
    protected function registerWeb(Request $request){
        $method = $request->method();

        if($request->isMethod('post')){
            $dataAnimal = $request->all();
            $newAnimal = new Animals;
            $newAnimal->name = $dataAnimal['name'];
            $newAnimal->size = $dataAnimal['size'];
            $newAnimal->type = $dataAnimal['type'];
            $newAnimal->description = $dataAnimal['description']; 
            $newAnimal->save();
            return redirect()->back();
        }
        if($request->isMethod('get')){
            return View::make('registerUser');
        }
    }

    protected function updateWeb(){
        
    }

    protected function deleteWeb(){
        
    }


}
