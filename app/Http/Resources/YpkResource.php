<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property string id
 * @property string ypk_name,
 * @property string description
 * @property  int $is_active
 */
class YpkResource extends JsonResource
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
            "ypkName" => $this->ypk_name,
            "description" => $this->description,
            "isActive" => (bool)$this->is_active
        ];
    }
}
