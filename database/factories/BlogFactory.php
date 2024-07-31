<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Blog::class;

    public function definition(): array
    {
        return [
          'title' => $this->faker->word,
            'content' => $this->faker->sentence,
            'status' => $this->faker->sentence,
        ];
    }
}
