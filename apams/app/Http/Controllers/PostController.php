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

    public function index()
    {
        $permissoes = json_decode(Auth::user()->permissoes);

        $visualizar = (in_array("postV", $permissoes)) ? true : false;
        $cadastrar = (in_array("postC", $permissoes)) ? true : false;
        $editar = (in_array("postE", $permissoes)) ? true : false;
        $remover = (in_array("postR", $permissoes)) ? true : false;

        if($visualizar == false && $cadastrar == false && $editar == false && $remover == false){
            return redirect()->back()->with('danger','Sem permissão para prosseguir!');
        }

        $nameUserAuth = Auth::user()->name;
        $avatarUserAuth = Auth::user()->avatar;
        return view('posts/posts')->with('nameUserAuth',$nameUserAuth)->with('avatarUserAuth',$avatarUserAuth)->with('permissoes',$permissoes);
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
                $newPost->image = "storage/posts/{$nomeimg}";
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
                $postUpdate->image = "storage/posts/{$nomeimg}";
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
    
}
