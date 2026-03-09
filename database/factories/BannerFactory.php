<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'image' => 'banners/banner.png',
            'url' => '#',
            'sort_order' => fake()->numberBetween(1, 5),
            'is_active' => true,
            'is_small' => false,
        ];
    }
}
