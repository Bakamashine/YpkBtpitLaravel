<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            "id" => 1,
            "role_name" => RoleName::Admin->value,
        ]);
        Role::create([
            "id" => 2,
            "role_name" => RoleName::Manager->value,
        ]);
        Role::create([
            "id" => 3,
            "role_name" => RoleName::User->value,
        ]);

    }
}
