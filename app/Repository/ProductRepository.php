<?php

namespace App\Repository;

use App\Contracts\Repository\IProductRepository;
use App\Enums\Enum\StatusProductEnum;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\StatusProduct;

class ProductRepository implements IProductRepository {

    public function getByStatus(string $status)
    {
        $status = StatusProduct::where('status_name', $status)->firstOrFail();
        $products = Product::where('status_product_id', $status)->get();
        return new ProductCollection($products);
    }
}
