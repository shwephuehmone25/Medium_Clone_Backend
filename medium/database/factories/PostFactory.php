<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title' => $this->faker->sentence(5),
            'description' => $this->faker->sentence(5),
            'user_id' => User::factory(1)->create()->first(),
            'image' => '/images' . rand(1, 2) . '.jpg',
        ];
    }
}