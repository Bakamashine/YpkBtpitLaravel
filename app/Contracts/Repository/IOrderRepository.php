<?php

namespace App\Contracts\Repository;

use App\Models\User;

interface IOrderRepository
{
    public function getByRole(User $user);
}
