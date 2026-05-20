<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct query()
 * @mixin \Eloquent
 */
class SelectedProduct extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'product_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
