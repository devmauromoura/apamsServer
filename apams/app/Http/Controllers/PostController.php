<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Post;
use ApamsServer\Animals;
use ApamsServer\User;
use Auth;
use View;

class PostController extends Controller
{
    public function show(){
        $posts = Post::all();
        $animals = Animals::all();
        $nameUserAuth = Auth::user()->name;
        return View::make('posts')->with(compact('nameUserAuth'))->with(compact('animals'))->with(compact('posts'));
    }

    protected function create(Request $request){
        $method = $request->method();

        if ($method == "POST") {
            $postData = $request->all();
            $newPost = new Post;
            $newPost->idAnimal = $request['animal'];
            $newPost->title = $request['titulo'];
            $newPost->description = $request['description'];
            $newPost->typePost = $request['finalidade'];
            $newPost->status = 0;
            $newPost->idUser = Auth::user()->id;
            $newPost->save();

            return redirect('posts');
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
            $postUpdate->idAnimal = $request['animal'];
            $postUpdate->title = $request['title'];
            $postUpdate->description = $request['description'];
            $postUpdate->typePost = $request['finalidade'];
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
