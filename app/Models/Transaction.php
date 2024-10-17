<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'products',
        'total_price',
        'weight',
        'quantity',
        'status',
        'ongkir',
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function totalHarga()
    {
        $result = $this->total_price - $this->ongkir;
        return Number::currency($result, 'IDR', 'id');
    }

    public function totalOngkir()
    {
        return Number::currency($this->ongkir, 'IDR', 'id');
    }

    public function biayaAdmin()
    {
        return Number::currency(1000, 'IDR', 'id');
    }

    public function grandTotal()
    {
        $recap = $this->total_price + 1000;
        return Number::currency($recap);
    }
}
