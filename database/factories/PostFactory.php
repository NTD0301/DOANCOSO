<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => collect(range(1, 4))->map(fn () => '<p>'.fake()->paragraph().'</p>')->implode(''),
            'author' => fake()->name(),
            'excerpt' => fake()->sentence(12),
            'image' => 'posts/200.png',
            'published_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
