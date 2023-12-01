<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }
}
