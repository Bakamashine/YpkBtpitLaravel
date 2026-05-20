<?php

namespace Database\Factories;

use App\Models\StatusProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StatusProduct>
 */
class StatusProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status_name' => fake()->randomElement(['Доступен', 'Зарезервирован', 'Продан', 'Снят с продажи']),
        ];
    }
}
