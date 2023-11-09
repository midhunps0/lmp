<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','name','phone','email','address'];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function managingPerson(){
        return $this->belongsTo(User::class,'managing_person_id');
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }
}
