<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;
use modules\Ynotz\AccessControl\Traits\WithRoles;


class Lead extends Model
{
    use HasFactory;
    use allScopes;
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class);
    }
    public function segments(){
        return $this->belongsTo(Segment::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function followup(){
        return $this->hasOne(Followup::class);
    }
   
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }
    public function leadtags(){
        return $this->belongsToMany(Tag::class,'leads_tags');
    }

    public function scopeDisplayingLeads($query)
    {
        // if (auth()->user()->client_id) {
        //     if(auth()->user()->branch_id && auth()->user()->hasRole('Branch Admin')){
        //         return $query->where('user_id', auth()->user()->id);
        //     }
        //     else{
        //         return $query->where('client_id', auth()->user()->client_id);
        //     }
        // }
        // return $query;

        if(auth()->user()->hasRole('Client Admin')){
            return $query->where('client_id', auth()->user()->client_id);
        }
        else if(auth()->user()->hasRole('Branch Admin')){
            return $query->where('branch_id', auth()->user()->branch_id);
        }
        else if(auth()->user()->hasRole('Executive')){
            return $query->where('user_id', auth()->user()->id);
        }
        else{
            return $query;
        }
    }
}
