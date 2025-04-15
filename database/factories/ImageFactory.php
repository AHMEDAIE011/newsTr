<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->date("Y-m-d h:m:s");
        $paths = [
            'uploads/posts/1.jpg', 'uploads/posts/2.jpg','uploads/posts/3.jpg' , 'uploads/posts/4.jpg' , 'uploads/posts/5.jpg',
            'uploads/posts/6.jpg','uploads/posts/7.jpg','uploads/posts/8.jpg',

    ];
        return [
            'path'=>fake()->randomElement($paths),
            "created_at" => $date,
            "updated_at" => $date,
        ];
       
    }
}
