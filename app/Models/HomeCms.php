<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeCms extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'home_banner',
        'home_brand',
        'home_category',
        'home_ads',
        'home_footer',
    ];

    protected $casts = [
        'home_banner' => 'array',
        'home_brand' => 'array',
        'home_category' => 'array',
        'home_ads' => 'array',
        'home_footer' => 'array',
    ];

    public function home_category(): HasMany
    {
        return $this->hasMany(Category::class, 'home_category');
    }

    public function banner()
    {
        $images = [];
        foreach ($this->home_banner as $value) {
            $images[] = CuratorMedia::where('id', $value)->first()?->hd;
        }
        return $images;
    }

    public function CategoryBanner()
    {
        $images = [];
        foreach ($this->home_category as $value) {
            $images[] = [
                'url' => Category::with('media')->where('id', $value)->first()?->media->first()->url,
                'title' => Category::where('id', $value)->first()
            ];
        }
        return $images;
    }
    public function Ads()
    {
        $images = [
            'banner' => CuratorMedia::where('id', $this->home_ads['banner'])->first()->hd,
            'title' => $this->home_ads['title'],
            'description' => $this->home_ads['description'],
            'cta_label' => $this->home_ads['cta_label'] ?? null,
            'cta_link' => $this->home_ads['cta_link'] ?? null,
        ];
        return $images;
    }
}
