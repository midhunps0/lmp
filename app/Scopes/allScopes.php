<?php
namespace App\Scopes;
trait allScopes{

    public function scopeUserClientBranch($query)
    {
        if (auth()->user()->client_id) {
            if(auth()->user()->branch_id){
                return $query->where('branch_id', auth()->user()->branch_id);
            }
            else{
                return $query->where('client_id', auth()->user()->client_id);
            }
            
                
        }

        return $query;
    }

    

   
}