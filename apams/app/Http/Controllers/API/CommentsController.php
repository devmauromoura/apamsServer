<?php

namespace ApamsServer\Http\Controllers\API;

use Illuminate\Http\Request;
use ApamsServer\Http\Controllers\Controller;
use ApamsServer\CommentPost;
use ApamsServer\Post;
use Auth;
use DB;

class CommentsController extends Controller
{
    public function show($idpost){
        // Busca todos os comentários do post e dados do usuário
        $Comments = DB::table('post_comments')
            ->select([
                'post_comments.id', 
                'post_comments.user_id',
                'post_comments.comment',
                'post_comments.created_at',
                'post_comments.updated_at',
                'users.name',
                'users.avataUrl',
                ])
            ->leftJoin('users', 'post_comments.user_id', '=', 'users.id')
            ->where('post_comments.post_id', $idpost)->get();

        return response()->json([
            "message" => "Sucesso",
            "status" => true,
            "data" => $Comments
        ]);
    }

    public function message(Request $request, $idpost){
        $message = $request['message'];

        $newComment = new CommentPost;
        $newComment->user_id = Auth::user()->id;
        $newComment->post_id = $idpost;
        $newComment->comment = $message;
        $newComment->save();

        return response()->json([
            "message" => "Comentário salvo com sucesso.",
            "status" => true,
        ]);
    }
}
