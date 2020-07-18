<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\Post;
use ApamsServer\User;
use ApamsServer\LikePost;
use Auth;

class PostController extends Controller
{

    public function show(){
        $Posts = Post::all();

        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $Posts
        ]);
    }


    public function showPost($id){
        $Post = Post::find($id);
        
        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $Post
        ]);
    }


    public function likePost($id){        
        if (LikePost::where('post_id',$id)->where('user_id', Auth::user()->id)->exists()){
            return response()->json([
                "message" => "Você já curtiu esse post.",
                "status" => true
            ]);
        }else {
            $like = new LikePost;
            $like->post_id = $id;
            $like->user_id = Auth::user()->id;
            $like->save();
        
            return response()->json([
                "message" => "Curtida registrada.",
                "status" => true
            ]);
        }
    }


    public function unlikePost($id){
        $userid =  Auth::user()->id;
        $unlike = LikePost::where('post_id', $id)->where('user_id', $userid);
        $unlike->delete();

        return response()->json([
            "message" => "Post descurtido.",
            "status" => true
        ]);
    }
}
