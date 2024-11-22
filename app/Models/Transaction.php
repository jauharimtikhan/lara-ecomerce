<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'note',
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
        $result = $this->total_price ?? 0 - $this->ongkir ?? 0;
        return Number::currency($result, 'IDR', 'id') ?? 'Rp. 0';
    }

    public function totalOngkir()
    {
        return Number::currency($this->ongkir ?? 0, 'IDR', 'id');
    }

    public function biayaAdmin()
    {
        return Number::currency(1000, 'IDR', 'id');
    }

    public function grandTotal()
    {
        $recap = $this->total_price + $this->ongkir + 1000;
        return Number::currency($recap, 'IDR', 'id');
    }

    public function formatDate()
    {
        Carbon::setLocale('ID');
        return Carbon::parse($this->created_at)
            ->isoFormat('dddd, D MMMM Y');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'id');
    }

    public function product($id)
    {
        return Product::with('gambarThumbnail')->find($id);
    }
    public function userDetail(): BelongsTo
    {
        return $this->belongsTo(UserDetail::class, 'user_id', 'user_id');
    }

    public function dateToDelivery()
    {
        Carbon::setLocale('ID');
        return Carbon::parse($this->created_at)
            ->subHours(24)
            ->isoFormat('dddd, D MMMM Y HH:mm:ss');
    }
}
