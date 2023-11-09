<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','subscription_id','amount'];
    public function clients(){
        return $this->belongsTo(Client::class);
    }
}
