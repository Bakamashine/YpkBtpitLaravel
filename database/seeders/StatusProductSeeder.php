<?php

namespace Database\Seeders;

use App\Models\StatusProduct;
use Illuminate\Database\Seeder;

class StatusProductSeeder extends Seeder
{
    public function run(): void
    {
        StatusProduct::create(['status_name' => 'Доступен']);
        StatusProduct::create(['status_name' => 'Зарезервирован']);
        StatusProduct::create(['status_name' => 'Продан']);
    }
}
