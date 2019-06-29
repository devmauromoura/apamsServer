<?php

namespace ApamsServer\Http\Controllers;

use Illuminate\Http\Request;
use ApamsServer\Post;
use ApamsServer\Animals;
use ApamsServer\User;
use ApamsServer\LikePost;
use Auth;
use View;
use DB;

class PostController extends Controller
{
    public function show(){
        //$posts = Post::all();
        $posts = DB::table('post')->leftJoin('animals','idAnimal','=','animals.id')->select(DB::raw('post.id, post.title, post.typePost, post.status, post.description, animals.name AS animalNome'))->get();
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

            return redirect('postagens')->with('msg', 'Post cadastrado!');
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
            $postUpdate = Post::find($request['idPost']);
            $postUpdate->idAnimal = $request['editarAnimal'];
            $postUpdate->title = $request['editarTitulo'];
            $postUpdate->description = $request['description'];
            $postUpdate->typePost = $request['editarFinalidade'];
            $postUpdate->status = $request['statusPost'];
            $newPost->save();

            return redirect('postagens')->with('msg', 'Post atualizado!');
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

    // Rotas API

    public function showApi(){
        $dataPost = DB::table('post')->leftJoin('animals','idAnimal','=','animals.id')->leftJoin('like_post','post.id','=','like_post.idPost')->select(DB::raw('post.id, post.title, post.typePost, post.status, post.description,post.created_at AS data, animals.id AS animalId,animals.name AS animalName, animals.avatarUrl as avatarAnimal, count(like_post.idPost) AS likes'))->orderBy('post.created_at', 'desc')->groupBy('post.id','post.title','post.typePost','post.status','post.description','animalId','animalName','avatarAnimal','post.created_at')->get();
        return response()->json($dataPost);
    }

    protected function showPost($id){
        $dataPost = $dataPost = DB::table('post')->leftJoin('animals','idAnimal','=','animals.id')->leftJoin('like_post','post.id','=','like_post.idPost')->select(DB::raw('post.id, post.title, post.typePost, post.status, post.description, animals.id AS animalId,animals.name AS animalName, count(like_post.idPost) AS likes'))->orderBy('post.id', 'desc')->groupBy('post.id','post.title','post.typePost','post.status','post.description','animalId','animalName')->where('post.id', $id)->get();

        return response()->json($dataPost);        
    }


    protected function likePost(Request $request){
        $dataLike =  $request['idPost'];
        
        if (LikePost::where('idPost',$dataLike)->where('idUser', Auth::user()->id)->exists()){
            return response()->json(['return' => 'Você já curtiu!'], 200);
        }else {
            $regLike = new LikePost;
            $regLike->idPost = $dataLike;
            $regLike->idUser = Auth::user()->id;
            $regLike->save();
        
            return response()->json(['return' => 'Curtida registrada!'], 401);
        }
    }


}
