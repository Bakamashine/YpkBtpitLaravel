<?php

namespace App\Contracts\Repository;

interface IProductRepository
{
    public function getByStatus(string $status);
}
