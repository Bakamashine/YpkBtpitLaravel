<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\StatusOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string $executor_id
 * @property string $customer_id
 * @property string $date
 * @property StatusOrder $statusOrder
 * @property string $customers_comment
 * @property string $user_comment
 * @property Product $product
 * @property User $user
 */
class OrderApiResource extends JsonResource
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
            "executorId" => $this->executor_id,
            'customerId' => $this->customer_id,
            'date' => $this->date,
            'statusName' => $this->statusOrder->status_name,
            'customersName' => null,
            'userComment' => $this->user_comment,
            'productDto' => ProductResource::make($this->product)
        ];
    }
}
