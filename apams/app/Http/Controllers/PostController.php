<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Post;
use View;

class PostController extends Controller
{
    public function show(){
        return Post::all();
    }

    protected function create(){

    }

    protected function update(){

    }

    protected function delete(){

    }
}



/*
id
idAnimal
title
description
typePost
status
idUser 
*/