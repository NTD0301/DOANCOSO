<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 10000, 200000),
            'sale_percentage' => fake()->numberBetween(0, 40),
            'stock' => fake()->numberBetween(10, 200),
            'image' => 'products/200.png',
            'image_1' => 'products/200.png',
            'image_2' => fake()->boolean(50) ? 'products/200.png' : null,
            'image_3' => fake()->boolean(30) ? 'products/200.png' : null,
            'image_4' => fake()->boolean(20) ? 'products/200.png' : null,
            'is_featured' => fake()->boolean(30),
        ];
    }
}
