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
            'idAnimal' => 1, 
            'title' => 'Post Exemplo',
            'description' => 'Esse é post exemplo para o feed da apams',
            'typePost' => 1,
            'status' => 1,
            'idUser' => 1,
            'cover' => 'iVBORw0KGgoAAAANSUhEUgAAAUAAAADwBAMAAACDA6BYAAAAG1BMVEUQ/vQAAAAO3tUEPz0GX1sKnpgCHx4MvrcIf3poHisBAAAB7ElEQVR4nO3UvW+bQBjH8Yczb+OhJMgjalPU0VRqs1IrkTLaUUs7gtXaHR2p8uwwpP2ze3fBNO5LlIHIUvT9IBDcI577iQNEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAOA58w4d4A+qOJ7tDdwLmOgHbsxVLRJoSdLpkwTr57mKJnsD3j9P//YhKEU2WrS6zZ4gV+/SHm6PM6/SYXImcVNIvNzKSeMCetXXzUr6QjOVk+Wn5drWkiQRtTABJS5tg5HINCq+DB5wYfa49UuvtUHlo1zLT7ONs7uA7XxbucLnzBSycxm/Gge1uzHM5GVmA6raNvDXMgnXrwcPaF+zMFO1W05ParMvJHfDNqDbxA3uCtoVVZ2LvLm70LZBVAaz8GrwfGbSRJvl0ibG6bvETOd1+72Au4Jd1V1Ac67dwT5B20AmI4mK1eABL90DcB/Etxf/eYK/C9IH9GcX0l3GpW0gP+zyVoMHzFul4zYqTcCVmsuFunHv4F5AV4jem3fwex8wzBZdQPMV2wZy2kqQbQYPGBXpVqqjmQm4SW/ET+fuK3YB7cLbzRWOriVo3vYBO91/0DQQvxS/ORs84OPlB5z7EWJ1fugIDxul5aEjAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPEe/AI5pPljbMkSDAAAAAElFTkSuQmCC',
        ]);

        LikePost::insert([
            'idPost' => 1,
            'idUser' => 1
        ]);

        CommentPost::insert([
            'idPost' => 1,
            'idUser' => 1,
            'comment' => 'Muito bom! Parabéns aos devs...'
        ]);
    }
}
