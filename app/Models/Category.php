<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'media',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function subcategory(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
    public function media(): BelongsTo
    {

        return $this->belongsTo(CuratorMedia::class, 'media_id');
    }
}
