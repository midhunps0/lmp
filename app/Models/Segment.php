<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','segments'];
    public function clients(){
        return $this->belongsTo(Client::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }
}
