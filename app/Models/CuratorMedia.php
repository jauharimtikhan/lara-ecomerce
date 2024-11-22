<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Format;
use Cloudinary\Transformation\Quality;
use Cloudinary\Transformation\Resize;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Storage;

class CuratorMedia extends Media
{
    use HasUuids;
    protected $table = 'media';
    protected $primaryKey = 'id';

    protected function url(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->disk === 'cloudinary') {
                    return (string) (new Cloudinary())
                        ->image($this->path)
                        ->resize(Resize::fit(800))
                        ->format(Format::auto())
                        ->quality(Quality::auto())
                        ->toUrl();
                }

                return Storage::disk($this->disk)->url($this->path);
            }
        );
    }

    protected function hd(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->disk === 'cloudinary') {
                    return (string) (new Cloudinary())
                        ->image($this->path)
                        ->format(Format::auto())
                        ->quality(Quality::auto())
                        ->toUrl();
                }

                return $this->getSignedUrl(['w' => 1024, 'h' => 1024, 'fit' => 'cover', 'fm' => 'webp']);
            }
        );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->disk === 'cloudinary') {
                    return (string) (new Cloudinary())
                        ->image($this->path)
                        ->resize(Resize::crop(200, 200))
                        ->format(Format::auto())
                        ->quality(Quality::auto())
                        ->toUrl();
                }

                return $this->getSignedUrl(['w' => 200, 'h' => 200, 'fit' => 'crop', 'fm' => 'webp']);
            }
        );
    }

    protected function mediumUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->disk === 'cloudinary') {
                    return (string) (new Cloudinary())
                        ->image($this->path)
                        ->resize(Resize::crop(640, 640))
                        ->format(Format::auto())
                        ->quality(Quality::auto())
                        ->toUrl();
                }

                return $this->getSignedUrl(['w' => 640, 'h' => 640, 'fit' => 'crop', 'fm' => 'webp']);
            }
        );
    }

    protected function largeUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->disk === 'cloudinary') {
                    return (string) (new Cloudinary())
                        ->image($this->path)
                        ->resize(Resize::crop(1024, 1024))
                        ->format(Format::auto())
                        ->quality(Quality::auto())
                        ->toUrl();
                }

                return $this->getSignedUrl(['w' => 1024, 'h' => 1024, 'fit' => 'contain', 'fm' => 'webp']);
            }
        );
    }
}
