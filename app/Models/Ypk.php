<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk query()
 * @mixin \Eloquent
 */
class Ypk extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['ypk_name', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        "is_active" => 1
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'ypk_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'ypk_id');
    }
}
