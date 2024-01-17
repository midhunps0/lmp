<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productType(){
        return $this->belongsTo(ProductType::class);
    }
    public function attributeValue(){
        return $this->hasMany(AttributeValue::class);
    }

    // Specify the 'value' attribute as JSON
    
   
   
}
