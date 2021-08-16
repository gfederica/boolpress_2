<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) 
    {
        for ($i = 1; $i < 10; $i++) {
            $newPost = new Post();
            $newPost->title = $faker->text(20) . $i;
            $newPost->slug = Str::slug($newPost->title, "-");
            $newPost->body = $faker->paragraph(3, true);
            $newPost->cover = $faker->imageUrl(360, 360);
        
            $newPost -> save();
        }

        
    }
    
}
