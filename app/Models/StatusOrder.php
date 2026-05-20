<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusOrder query()
 * @mixin \Eloquent
 */
class StatusOrder extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['status_name'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'status_order_id');
    }
}
