<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $post =   Post::factory()->count(50)->create();


      // Associate images with each post
      $post->each(function (Post $post) {

            // Create 2 random images for each post and associate them with the post
            Image::factory(2)->create([
                "post_id"=> $post->id,      
            ]);
      });
    }
}
