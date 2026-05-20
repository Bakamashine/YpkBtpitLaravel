<?php

namespace Database\Factories;

use App\Models\Ypk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ypk>
 */
class YpkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ypk_name' => fake()->company(),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
