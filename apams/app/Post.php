<?php

namespace ApamsServer;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";

    public function comments()
    {
         return $this->hasMany('ApamsServer\CommentPost');
    }
}
