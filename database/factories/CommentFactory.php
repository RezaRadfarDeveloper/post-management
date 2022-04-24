<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posts = BlogPost::all();
        return [
            'content' => $this->faker->paragraphs(3,true),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
