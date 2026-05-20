<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SelectedProduct> $selectedProducts
 * @property-read int|null $selected_products_count
 * @property-read \App\Models\StatusProduct|null $statusProduct
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Ypk|null $ypk
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'product_name',
        'ypk_id',
        'user_id',
        'status_product_id',
        'product_cost',
        'product_info',
        'is_product',
        'photo_path',
        'address',
    ];

    protected $casts = [
        'product_cost' => 'decimal:2',
        'is_product' => 'boolean',
    ];

    public function ypk(): BelongsTo
    {
        return $this->belongsTo(Ypk::class, 'ypk_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusProduct(): BelongsTo
    {
        return $this->belongsTo(StatusProduct::class, 'status_product_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    public function selectedProducts(): HasMany
    {
        return $this->hasMany(SelectedProduct::class, 'product_id');
    }
}
