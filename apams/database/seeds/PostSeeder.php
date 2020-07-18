<?php

use Illuminate\Database\Seeder;
use ApamsServer\Post;
use ApamsServer\LikePost;
use ApamsServer\CommentPost;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::insert([
            [
                'title' => 'Post Exemplo 1',
                'description' => 'Esse é post exemplo para o feed da apams',
                'user_id' => 1,
                'image' => 'url',
            ],
            [
                'title' => 'Post Exemplo 2 ',
                'description' => 'Esse é post exemplo para o feed da apams',
                'user_id' => 1,
                'image' => 'url',
            ],
            [
                'title' => 'Post Exemplo 3',
                'description' => 'Esse é post exemplo para o feed da apams',
                'user_id' => 1,
                'image' => '',
            ],
            [
                'title' => 'Post Exemplo',
                'description' => 'Esse é post exemplo para o feed da apams',
                'user_id' => 1,
                'image' => '',
            ],
        ]);

        LikePost::insert([
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 2,
                'user_id' => 1
            ],
            [
                'post_id' => 2,
                'user_id' => 1
            ],
            [
                'post_id' => 3,
                'user_id' => 1
            ],
        ]);

        CommentPost::insert([
            [
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 1,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 2,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
            [
                'post_id' => 3,
                'user_id' => 1,
                'comment' => 'Muito bom! Parabéns aos devs...'
            ],
        ]);
    }
}
