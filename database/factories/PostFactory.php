<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;
    public function definition()
    {
        return [
            'user_id'=> $this->faker->numberBetween($min = 1, $max =10),
            'description' => $this->faker->text(),
            'status' => $this->faker->numberBetween($min = 0, $max =2),
        ];
    }
}
