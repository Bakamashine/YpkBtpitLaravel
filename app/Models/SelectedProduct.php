<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $user_id
 * @property string $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedProduct whereUserId($value)
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
