<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Cart as FacadesCart;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Cart extends FacadesCart
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'sub_total',
        'grand_total',
        'weight',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function formatRupiah($column)
    {
        $collumns = match ($column) {
            'sub_total' => $this->sub_total,
            'grand_total' => $this->grand_total,
        };
        return Number::currency($collumns, 'IDR', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        return $this->belongsTo(Product::class);
    }
}
