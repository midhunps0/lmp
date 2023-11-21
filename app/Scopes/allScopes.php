<?php
namespace App\Scopes;
trait allScopes{

    public function scopeUserClientBranch($query)
    {
        if (auth()->user()->client_id) {
            return $query->where('client_id', auth()->user()->client_id)
                ->where('branch_id', auth()->user()->branch_id);
        }

        return $query;
    }

    public function scopeWithRoles($query)
    {
        return $query->with([
            'roles' => function ($query) {
                $query->select('id', 'name');
            }
        ]);
    }

    public function scopeUserBranches($query){
        if (auth()->user()->branch_id) {
            return $query->where('client_id', auth()->user()->client_id)
                         ->where('id', auth()->user()->branch_id)
                         ->orderBy('id','desc');
        } 
        return $query;
        
    }
}