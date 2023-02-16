<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'url' => '/images' . rand(1, 2) . '.jpg',
            'imageable_id' => Post::all()->random()->id,
            'imageable_type' => 'App\Models\Post',

        ];
    }
}