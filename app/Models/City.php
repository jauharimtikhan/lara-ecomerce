<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'city_id';
    protected $fillable = [
        'city_id',
        'city_name',
        'province_id',
        'type',
        'postal_code',
    ];

    public function province(): BelongsToMany
    {
        return $this->belongsToMany(Provinsi::class);
    }
}
