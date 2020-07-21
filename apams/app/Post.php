<?php

namespace ApamsServer;

use Illuminate\Database\Eloquent\Model;
use ApamsServer\User;

class Post extends Model
{
    protected $table = "post";

    public function comments()
    {
         return $this->hasMany('ApamsServer\CommentPost')->with(['getUser']);
    }
}
