<?php

namespace Database\Seeders;

use App\Enums\Enum\StatusProductEnum;
use App\Models\StatusProduct;
use Illuminate\Database\Seeder;

class StatusProductSeeder extends Seeder
{
    public function run(): void
    {

        foreach (StatusProductEnum::cases() as $_) {
            StatusProduct::create(['status_name' => $_->value]);
        }
//        StatusProduct::create(['status_name' => 'Доступен']);
//        StatusProduct::create(['status_name' => 'Зарезервирован']);
//        StatusProduct::create(['status_name' => 'Продан']);
    }
}
