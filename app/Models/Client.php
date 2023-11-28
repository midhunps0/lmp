<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    
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
        return $this->hasOne(Segment::class);
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
    public function sources(){
        return $this->hasMany(Source::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'clients_tags');
    }
    public  function action(){
        return $this->hasOne(Action::class);
        
    }
    public function subscription(){
        return $this->belongsToMany(SubscriptionModel::class,'client_subscriptions','client_id','subscription_model_id');
    }

}
