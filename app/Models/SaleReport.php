<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class SaleReport extends Model
{
    use HasUuids;

    protected $fillable = [
        'data_reports'
    ];
}
