<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_name' => fake()->words(3, true),
            'product_cost' => fake()->randomFloat(2, 100, 100000),
            'product_info' => fake()->paragraph(),
            'is_product' => fake()->boolean(),
            'photo_path' => null,
            'address' => fake()->address(),
        ];
    }
}
