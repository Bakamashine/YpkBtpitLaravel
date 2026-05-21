<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $userRole = Role::where('role_name', RoleName::User->value)->first();
        $adminRole = Role::where('role_name', RoleName::Admin->value)->first();

        if (!$userRole || !$adminRole) {
            $this->call(RoleSeeder::class);
            $userRole = Role::where('role_name', RoleName::User->value)->first();
            $adminRole = Role::where('role_name', RoleName::Admin->value)->first();
        }

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Default User',
                'password' => Hash::make('password'),
                'phone_number' => '+79991111111',
                'role_id' => $userRole->id,
                'user_info' => 'Default user',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone_number' => '+79992222222',
                'role_id' => $adminRole->id,
                'user_info' => 'Administrator',
                'is_active' => true,
            ]
        );
    }
}
