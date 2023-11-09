<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['subscription_model_id','valid_till'];
    public function subscriptionModel(){
        return $this->belongsTo(SubscriptionModel::class);
    }
}
