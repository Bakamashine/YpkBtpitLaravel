<?php

namespace App\Repository;

use App\Contracts\Repository\IOrderRepository;
use App\Models\Order;
use App\Models\User;

class OrderRepository implements IOrderRepository
{
    public function getByRole(User $user)
    {
        if ($user->role_id == 1) {
            return Order::all();
        }

        if ($user->role_id == 2) {
            return Order::where('executor_id', $user->id)->get();
        }

        return Order::where('customer_id', $user->id)->get();
    }
}
