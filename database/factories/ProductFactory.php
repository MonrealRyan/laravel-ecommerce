<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'short_description' => fake()->sentence(),
            'long_description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'category_id' => fake()->numberBetween(1, 3),
            'picture' => fake()->imageUrl(640, 480, 'gadgets', true),
        ];
    }

    function couches() : Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'category_id' => Category::COUCHES,
            ];
        });
    }

    function chairs() : Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'category_id' => Category::COUCHES,
            ];
        });
    }

    function dinnings() : Factory
    {
        return $this->state(function(array $attributes) {
            return [
                'category_id' => Category::COUCHES,
            ];
        });
    }
}
