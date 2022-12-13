<?php

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->words(5, true);
            $newPost->slug = Str::of($newPost->title)->slug('_');
            $newPost->content = $faker->text();
            $newPost->save();
        }
    }
}
