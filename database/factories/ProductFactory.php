<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'images' => [
                $this->faker->imageUrl(800, 800, 'fasion'),
                $this->faker->imageUrl(800, 800, 'fasion'),
                $this->faker->imageUrl(800, 800, 'fasion'),
            ],
            'thumbnail' => $this->faker->imageUrl(400, 400, 'fasion')
        ];
    }
}
