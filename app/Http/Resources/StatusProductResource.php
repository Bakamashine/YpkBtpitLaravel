<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
* @property string id
* @property string status_name
*/
class StatusProductResource extends JsonResource
{
    public static $wrap = 'statusProducts';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'statusName' => $this->status_name
        ];
    }
}
