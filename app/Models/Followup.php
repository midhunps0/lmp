<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;
    public function lead(){
        return $this->belongsTo(Lead::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function scopeDisplayFollowups($query){
        $user = auth()->user();
        $lead = Lead::find($user->lead_id);
        
        if($lead){
            if ($user->hasRole('Client Admin')) {
                $relatedClient=$lead->client;
                return $query->where($relatedClient->id,$user->client_id);
            }
            else if($user->hasRole('Branch Admin')){
                $relatedBranch=$lead->branch;
                return $query->where($relatedBranch->id,$user->branch_id);
            }
            else if($user->hasRole('Executive')){
                return $query->where('user_id',$user->id);
            }
        }
        return $query;

    }
}
