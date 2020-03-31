<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $postCount = count(Post::all()->toArray()) -1;

        for ($i=0; $i < 10 ; $i++) {

          $newComment = new Comment;
          $newComment->post_id = rand(1, $postCount);
          $newComment->name = $faker->name;
          $newComment->email = $faker->email;
          $newComment->body = $faker->text(255);

          $newComment->save();
        }
    }
}
