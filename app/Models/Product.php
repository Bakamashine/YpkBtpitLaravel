<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
