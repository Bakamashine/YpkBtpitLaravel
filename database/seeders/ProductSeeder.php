<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\User;
use App\Models\Ypk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ypk = Ypk::first() ?? Ypk::factory()->createOne();

        $statuses = StatusProduct::all();
        if ($statuses->isEmpty()) {
            $statuses = StatusProduct::factory()->count(3)->create();
        }

        $user = User::first();
        if (!$user) {
            $user = new User();
            $user->id = Str::uuid();
            $user->name = 'Иван Иванов';
            $user->email = 'ivan@example.com';
            $user->password = Hash::make('password');
            $user->phone_number = '+7 (999) 123-45-67';
            $user->user_info = 'Тестовый пользователь';
            $user->is_active = true;
            $user->save();
        }

        Product::factory(20)->create([
            'ypk_id' => $ypk->id,
            'user_id' => $user->id,
            'status_product_id' => $statuses->random()->id,
        ]);
    }
}
