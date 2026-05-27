<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $id
 * @property string name
 * @property string phone_number,
 * @property string email,
 * @property ?string user_info
 * @property ?string avatar
 * @property Role role
 */
class UserResource extends JsonResource
{

    /**
     * @param bool $condition
     * @param Request $request
     * @param JsonResource|string $instanceOrClass
     * @param mixed|null $model
     * @return MergeValue|mixed
     */
    public function mergeResourceWhen($condition, $request, $instanceOrClass, $model = null)
    {
        return $this->mergeResourcesWhen($condition, $request, [$instanceOrClass], $model);
    }

    /**
     * @param Request $request
     * @param JsonResource|string $instanceOrClass
     * @param mixed|null $model
     * @return MergeValue|mixed
     */
    public function mergeResource($request, $instanceOrClass, $model = null)
    {
        return $this->mergeResourceWhen(true, $request, $instanceOrClass, $model);
    }

    /**
     * @param bool $condition
     * @param Request $request
     * @param JsonResource[]|string[] $instancesOrClasses
     * @param mixed|null $model
     * @return MergeValue|mixed
     */
    public function mergeResourcesWhen($condition, $request, $instancesOrClasses, $model = null)
    {
        return $this->mergeWhen($condition, function () use ($request, $instancesOrClasses, $model) {
            return array_merge(...array_map(function ($instanceOrClass) use ($model, $request) {
                if ($instanceOrClass instanceof JsonResource) {
                    if ($model) {
                        throw new RuntimeException('$model is specified but not used.');
                    }
                } else {
                    $instanceOrClass = new $instanceOrClass($model ?? $this->resource);
                }
                return $instanceOrClass->toArray($request);
            }, $instancesOrClasses));
        });
    }

    /**
     * @param Request $request
     * @param JsonResource[]|string[] $instancesOrClasses
     * @param mixed|null $model
     * @return MergeValue|mixed
     */
    public function mergeResources($request, $instancesOrClasses, $model = null)
    {
        return $this->mergeResourcesWhen(true, $request, $instancesOrClasses, $model);
    }

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
            "userInfo" => $this->user_info,
            "avatarUrl" => $this->avatar
                ? Storage::disk('public')->url($this->avatar)
                : null
        ];
    }
}
