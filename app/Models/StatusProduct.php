<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $status_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\StatusProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct whereStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusProduct whereUpdatedAt($value)
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
