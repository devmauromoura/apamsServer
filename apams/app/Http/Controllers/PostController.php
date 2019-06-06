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

    protected function create(Request $request){
        $method = $request->method();

        if ($method == "POST") {
            $postData = $request->all();
            $newPost = new Post;
            $newPost->idAnimal = $request['idAnimal'];
            $newPost->title = $request['title'];
            $newPost->description = $request['description'];
            $newPost->typePost = $request['typePost'];
            $newPost->status = $request['status'];
            $newPost->idUser = Auth::user()->id;
            $newPost->save();

            return "Post cadastrado com sucesso";
        }
        elseif ($method == "GET") {
            return View::make('Post.create');
        }
        else {
            return "Metodo não esperado!";
        }
    }

    protected function update(Request $request){
        $method = $request->method();

        if ($method == "POST") {
            $postData = $request->all();
            $postUpdate = Post::find($request['id']);
            $postUpdate->idAnimal = $request['idAnimal'];
            $postUpdate->title = $request['title'];
            $postUpdate->description = $request['description'];
            $postUpdate->typePost = $request['typePost'];
            $postUpdate->status = $request['status'];
            $newPost->save();

            return "Update Realizado com Sucesso!";
        }
        elseif ($method == "GET") {
            return view('Post.update');
        }
        else {
            return "Metodo não esperado!";
        }
    }

    protected function delete(Request $request){
        $postDeleteId = $request['id'];
        $postDelete = Post::find($postDeleteId);
        $postDelete->delete();

        return "Post removido com sucesso!";
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
