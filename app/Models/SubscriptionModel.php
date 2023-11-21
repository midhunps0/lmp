<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionModel extends Model
{
    use HasFactory;
    protected $fillable = ["model","fee"];
    public static array $models=["Silver","Gold","Platinum"];

    public function clients(){
        return $this->belongsToMany(Client::class,'client_subscriptions','subscription_model_id','client_id');
    }
    
}
