<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $product_name
 * @property string $ypk_id
 * @property string $user_id
 * @property string $status_product_id
 * @property numeric $product_cost
 * @property string $product_info
 * @property bool $is_product
 * @property string|null $photo_path
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SelectedProduct> $selectedProducts
 * @property-read int|null $selected_products_count
 * @property-read \App\Models\StatusProduct $statusProduct
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Ypk $ypk
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStatusProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereYpkId($value)
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

    public function favourite(): \Illuminate\Database\Eloquent\Builder|HasMany|Product
    {
        return $this->hasMany(Favourite::class, 'product_id');
    }
}
