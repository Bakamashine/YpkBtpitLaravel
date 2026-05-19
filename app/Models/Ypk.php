<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ypk extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['ypk_name', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
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
