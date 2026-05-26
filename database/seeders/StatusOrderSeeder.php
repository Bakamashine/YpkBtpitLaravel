<?php

namespace Database\Seeders;

use App\Enums\StatusOrderEnum;
use App\Models\StatusOrder;
use Illuminate\Database\Seeder;

class StatusOrderSeeder extends Seeder
{
    public function run(): void
    {
        foreach (StatusOrderEnum::cases() as $status) {
            StatusOrder::firstOrCreate(['status_name' => $status->value]);
        }
    }
}
