<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Laravel\Scout\Searchable;

class Product extends Model implements Buyable
{
    use HasFactory, HasUuids, SoftDeletes, Searchable;
    use \Gloudemans\Shoppingcart\CanBeBought;
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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'updated_at' => $this->updated_at,
            'thumbnail' => CuratorMedia::where('id', $this->thumbnail)->first()->url
        ];
    }

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

        return $this->belongsTo(SubCategory::class, 'sub_category_id');
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

    public function gambarThumbnail(): BelongsTo
    {

        return $this->belongsTo(CuratorMedia::class, 'thumbnail', 'id');
    }

    public function thumbnail(): BelongsTo
    {

        return $this->belongsTo(CuratorMedia::class);
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    public function getBuyableWeight($options = null)
    {
        return $this->weight;
    }

    // public function media(): BelongsToMany
    // {

    //     return $this->belongsToMany(CuratorMedia::class, 'product_galleries');
    // }
}
