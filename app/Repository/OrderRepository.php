<?php

namespace App\Repository;

use App\Contracts\Repository\IOrderRepository;
use App\Enums\RoleName;
use App\Models\Order;
use App\Models\User;

class OrderRepository implements IOrderRepository
{
    public function getByRole(User $user)
    {
        if ($user->role?->role_name === RoleName::Admin->value) {
            return Order::all();
        }

        if ($user->role?->role_name === RoleName::Manager->value) {
            return Order::where('executor_id', $user->id)->get();
        }

        return Order::where('customer_id', $user->id)->get();
    }
}
