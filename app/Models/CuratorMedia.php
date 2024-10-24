<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CuratorMedia extends Media
{
    use HasFactory, HasUuids;

    protected $table = 'media';


    public function gambarThumbnail(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'thumbnail');
    }
}
