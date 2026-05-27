<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Ypk;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property string id,
 * @property string comment,
 * @property int rating
 * @property User user
 * @property Ypk ypk
 */
class FeedbackResource extends JsonResource
{

//    public static $wrap = "feedbacks";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "comment" => $this->comment,
            "raiting" => $this->rating,
            "user" => UserResource::make($this->user),
            "ypk" => $this->ypk ? YpkResource::make($this->ypk) : null,
        ];
    }
}
