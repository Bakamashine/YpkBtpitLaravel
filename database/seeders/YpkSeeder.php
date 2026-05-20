<?php

namespace Database\Seeders;

use App\Models\Ypk;
use Illuminate\Database\Seeder;

class YpkSeeder extends Seeder
{
    public function run(): void
    {
        Ypk::create([
            'ypk_name' => 'ЮПК БТПиТ',
            'description' => 'Юргинский промышленный колледж Бизнеса и Технологий',
            'is_active' => true,
        ]);
    }
}
