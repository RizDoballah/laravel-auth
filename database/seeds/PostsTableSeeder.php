<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\str;



class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i <10 ; $i++) {
        $newPost = new Post;
        $newPost->user_id = rand(1, 3);
        $newPost->title = $faker->sentence(3);
        $newPost->body = $faker->text(255);
        $newPost->slug = Str::finish(Str::slug($newPost->title), rand(1, 1000));
        $newPost->published = rand(0, 1);

        $newPost->save();
      }

    }
}
