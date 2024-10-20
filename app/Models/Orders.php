<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class Orders extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'status',
        'sub_total',
        'grand_total',
        'weight',
        'address',
        'quantity',
        'notes'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formatedDate()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM Y');
    }

    public function summerizePrice()
    {
        $convert = ($this->product->price * $this->quantity) + $this->grand_total;
        return Number::currency($convert, 'IDR', 'id');
    }

    public static function customQuery()
    {
        return collect(self::query()->where('user_id', Auth::user()->id)->get())->filter(function ($item) {
            return $item->user_id == Auth::user()->id;
        });
    }
}
