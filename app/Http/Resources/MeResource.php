<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $id
 * @property string name
 * @property string phone_number,
 * @property string email,
 * @property Role role
 */
class MeResource extends JsonResource
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
            "name" => $this->name,
            "phoneNumber" => $this->phone_number,
            "email" => $this->email,
            "role" => $this->role->role_name
        ];
    }
}
