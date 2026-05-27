<?php

namespace App\Http\Resources;

use App\Models\StatusProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


/**
 * @property string $id
 * @property string $ypk_id
 * @property string $product_name
 * @property int $product_cost
 * @property string $product_info
 * @property int $is_product
 * @property ?string $photo_path
 * @property string $address
 * @property string status_product_id
 * @property StatusProduct $statusProduct
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ypkId' => $this->ypk_id,
            'productName' => $this->product_name,
            'productCost' => $this->product_cost,
            'productInfo' => $this->product_info,
            'isProduct' => (bool)$this->is_product,
            'photoPath' => $this->photo_path,
            'photoUrl' => $this->photo_path
                ? Storage::disk("public")->url($this->photo_path)
                : null,
            'address' => $this->address,
            'statusProductId' => $this->status_product_id
        ];
    }
}
