<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\User|null $customer
 * @property-read \App\Models\User|null $executor
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\StatusOrder|null $statusOrder
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'customer_id',
        'executor_id',
        'product_id',
        'status_order_id',
        'date',
        'customers_comment',
        'user_comment',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function statusOrder(): BelongsTo
    {
        return $this->belongsTo(StatusOrder::class, 'status_order_id');
    }
}
