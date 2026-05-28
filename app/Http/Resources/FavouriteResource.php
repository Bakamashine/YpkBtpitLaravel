<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property  string $id
 * @property  Product $product
 * @property  User $user
 */
class FavouriteResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product" => ProductResource::make($this->product),
            "user" => UserResource::make($this->user)
        ];
    }
}
