<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\Ypk;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


/**
 * @property string $id
 * @property string $name
 * @property  string $phone_number
 * @property string $user_info
 * @property  boolean $is_active
 * @property  string $avatar
 * @property  Role $role
 * @property  Ypk $ypk
 */
class UserApiResource extends JsonResource
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
            'fullName' => $this->name,
            'phoneNumber' => $this->phone_number,
            'userInfo' => $this->user_info,
            'isActive' => $this->is_active,
            'avatarPath' => $this->avatar,
            'avatarUrl' => $this->avatar
                ? Storage::disk("public")->url($this->avatar)
                : null,
            'role' => RoleResource::make($this->role),
            'ypk' => $this?->ypk
                ? YpkResource::make($this->ypk)
                : null
        ];
    }
}
