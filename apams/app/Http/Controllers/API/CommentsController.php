<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\CommentPost;
use ApamsServer\Post;
use Auth;

class CommentsController extends Controller
{
    public function show($idpost){
        $Comments = Post::find($idpost);
        

        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $Comments->comments
        ]);
    }
}
