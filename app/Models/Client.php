<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','address','email',
    'password','isValid','subscription_model_id','subscription_id','managing_person_id'];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function managingPerson(){
        return $this->belongsTo(User::class,'managing_person_id');
    }
    public function branch(){
        return $this->hasMany(Branch::class);
    }
    public function stage(){
        return $this->hasOne(Stage::class);
    }
    public function segments(){
        return $this->hasMany(Segment::class);
    }
    public function templates(){
        return $this->hasMany(Template::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function payments(){
        return $this->hasOne(Payment::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }

}
