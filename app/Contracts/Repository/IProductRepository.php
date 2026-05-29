<?php

namespace App\Contracts\Repository;

use App\Enums\Enum\StatusProductEnum;
use App\Http\Resources\ProductCollection;

interface IProductRepository
{
    public function getByStatus(StatusProductEnum $status): ProductCollection;
}
