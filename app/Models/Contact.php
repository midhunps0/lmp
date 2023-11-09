<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public function leads(){
        return $this->belongsTo(Lead::class);
    }
    public function numbers(){
        return $this->hasMany(Number::class);
    }
    public function emails(){
        return $this->hasMany(Email::class);
    }
}
