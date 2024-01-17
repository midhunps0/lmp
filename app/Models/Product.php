<?php

namespace App\Models;

use App\Models\Attribute as ModelsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory , OwnsMedia;
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function productvariants(){
        return $this->hasMany(Productvariant::class);
    }

    public function orderitem(){
        return $this->hasMany(OrderItem::class);
    }
   
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
   
    
    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images'
            ],
            'imageSecond'=>[
                'disk'=>'public',
                'folder'=>'images'
            ]
        ];
    }
   public function productTypes(){
    return $this->belongsTo(ProductType::class);
   }
    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                //return $this->getAllMedia('image');
                return $this->getSingleMediaForEAForm('image');
            }
        );
    }
    public function imageSecond(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->getSingleMediaForEAForm('imageSecond');
            }
        );
    }
}
