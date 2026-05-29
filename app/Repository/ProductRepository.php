<?php

namespace App\Repository;

use App\Contracts\Repository\IProductRepository;
use App\Enums\Enum\StatusProductEnum;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\StatusProduct;

class ProductRepository implements IProductRepository {

    public function getByStatus(StatusProductEnum $status): ProductCollection
    {
        $statusModel = StatusProduct::where('status_name', $status->value)->firstOrFail();
        $products = Product::where('status_product_id', $statusModel->id)->get();
        return new ProductCollection($products);
    }
}
