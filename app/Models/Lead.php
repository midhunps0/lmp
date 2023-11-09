<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    public function clients(){
        return $this->belongsTo(Client::class);
    }
    public function branches(){
        return $this->belongsTo(Branch::class);
    }
    public function stages(){
        return $this->belongsTo(Stage::class);
    }
    public function segments(){
        return $this->belongsTo(Segment::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function followups(){
        return $this->hasMany(Followup::class);
    }
    public function appoiments(){
        return $this->hasMany(Appoiment::class);
    }
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }
}
