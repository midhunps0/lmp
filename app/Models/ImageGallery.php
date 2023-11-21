<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageGallery extends Model
{
    use HasFactory, OwnsMedia;

    protected $guarded = [];
    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images'
            ]
        ];
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->getSingleMediaForEAForm('image');
            }
        );
    }
}
