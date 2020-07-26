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

// Rotas Front

    public function index()
    {
        $nameUserAuth = Auth::user()->name;
        return view('posts/posts')->with('nameUserAuth',$nameUserAuth);
    }

    public function getDados()
    {
        try {
            $posts = Post::all();
        } catch (\Throwable $th) {
            $posts = [];
        }
        return response()->json(['data' => $posts]);
    }

    public function infoPost($id)
    {

        return view('posts/posts_info_formulario');
    }

    public function formulario($id=null)
    {
        $data = [];

        if($id){
            $data =Post::find($id);
        }
        return view('posts/posts_formulario')->with('dados',$data);
    }

    public function salvar(Request $request)
    {
        if(isset($request['images'])){
            try {
                $ext = $request->file('images')[0]->extension();
                $data = date('d-m-Y_H-i-s');
                $nomeimg = "post_{$data}.{$ext}";
    
                $saveStorage = $request->file('images')[0]->storeAs('posts',$nomeimg); 
            } catch (\Throwable $th) {
                return redirect('postagens')->with('danger', 'Erro ao cadastrar o post! [IMG]');
            }
        }
        
        try {
            $newPost = new Post;
            $newPost->title = $request['titulo'];
            $newPost->description = $request['descricao'];
            if(isset($request['images'])){
                $newPost->image = $nomeimg;
            }
            $newPost->user_id = Auth::user()->id;
            $newPost->save();
        } catch (\Throwable $th) {
            return redirect('postagens')->with('danger', 'Erro ao cadastrar o post! [BD]');
        }

        return redirect('postagens')->with('success', 'Post cadastrado com sucesso!');
    }

    public function editar(Request $request, $id)
    {
        if(isset($request['images']))
        {
            try {
                $ext = $request->file('images')[0]->extension();
                $data = date('d-m-Y_H-i-s');
                $nomeimg = "post_{$data}.{$ext}";
    
                $saveStorage = $request->file('images')[0]->storeAs('posts',$nomeimg); 
            } catch (\Throwable $th) {
                return redirect('postagens')->with('danger', 'Erro ao cadastrar o post! [IMG]');
            }
        }

        try {
            $postUpdate = Post::find($id);
            $postUpdate->title = $request['titulo'];
            $postUpdate->description = $request['descricao'];
            if(isset($request['images'])){
                $postUpdate->image = $nomeimg;
            } elseif (!isset($request['images']) && !isset($request['preloaded'])) {
                $postUpdate->image = "";
            }
            $postUpdate->save();
        } catch (\Throwable $th) {
            return redirect('postagens')->with('danger', 'Erro ao cadastrar o post! [BD]');
        }

        return redirect('postagens')->with('success', 'Post editado com sucesso!');
    }

    public function remover(Request $request, $id)
    {
        try {
            $postDelete = Post::find($id);
            $postDelete->delete();
        } catch (\Throwable $th) {
            return redirect('postagens')->with('danger', 'Erro ao remover o post! [BD]');
        }

        return redirect('postagens')->with('success', 'Post removido com sucesso!');
    }

// Rotas Front

// Rotas API

    public function showApi(){
        $dataPost = DB::table('post')->leftJoin('animals','idAnimal','=','animals.id')->leftJoin('like_post','post.id','=','like_post.idPost')->select(DB::raw('post.id, post.title, post.typePost, post.status, post.description,post.created_at AS data, animals.id AS animalId,animals.name AS animalName, animals.avatarUrl as avatarAnimal, count(like_post.idPost) AS likes'))->orderBy('post.created_at', 'desc')->groupBy('post.id','post.title','post.typePost','post.status','post.description','animalId','animalName','avatarAnimal','post.created_at')->get();
        return response()->json($dataPost);
    }

    protected function showPost($id){
        $dataPost = $dataPost = DB::table('post')->leftJoin('animals','idAnimal','=','animals.id')->leftJoin('like_post','post.id','=','like_post.idPost')->select(DB::raw('post.id, post.title, post.typePost, post.status, post.description, animals.id AS animalId,animals.name AS animalName, count(like_post.idPost) AS likes'))->orderBy('post.id', 'desc')->groupBy('post.id','post.title','post.typePost','post.status','post.description','animalId','animalName')->where('post.id', $id)->get();

        return response()->json($dataPost);        
    }


    protected function likePost($id){
        $dataLike =  $id;
        
        if (LikePost::where('idPost',$dataLike)->where('idUser', Auth::user()->id)->exists()){
            return response()->json('Você já curtiu!');
        }else {
            $regLike = new LikePost;
            $regLike->idPost = $dataLike;
            $regLike->idUser = Auth::user()->id;
            $regLike->save();
        
            return response()->json('Curtida registrada!');
        }
    }

// Rotas API

}
