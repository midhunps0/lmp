<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = ['stages'];
    protected $guarded = [];
    public function clients(){
        return $this->belongsToMany(Client::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }
}
