<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'product_galleries',
        'price',
        'discount',
        'is_active',
        'is_featured',
        'stock',
        'weight',
        'category_id',
        'sub_category_id',
        'user_id',
    ];
    protected $casts = [
        'product_galleries' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function riview(): BelongsTo
    {
        return $this->belongsTo(ReviewProduct::class);
    }
    public function subcategory(): BelongsTo
    {

        return $this->belongsTo(SubCategory::class);
    }

    public function formatDate()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->created_at)
            ->locale('id')
            ->translatedFormat('l, d/M/Y');
    }

    public function formatRupiah()
    {
        return Number::currency($this->price, 'IDR', 'id');
    }
}
