<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct query()
 * @mixin \Eloquent
 */
class StatusProduct extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['status_name'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'status_product_id');
    }
}
