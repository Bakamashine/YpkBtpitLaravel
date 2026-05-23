<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $ypk_name
 * @property string|null $description
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\YpkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ypk whereYpkName($value)
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
