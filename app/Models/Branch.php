<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Branch extends Model
{
    use HasFactory;
    use allScopes;
    use OwnsMedia;
    protected $fillable = ['client_id','name','phone','email','address'];

    public function users(){
        return $this->hasMany(User::class);
    }
    public function managingPerson(){
        return $this->belongsTo(User::class,'managing_person_id');
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }

    public function getMediaStorage(): array
    {
        return[
            'image'=>[
                'disk'=>'public',
                'folder'=>'images'
            ]
        ];
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->getSingleMediaForEAForm('image');
            }
        );
    }

    public function scopeUserBranches($query){
        if(auth()->user()->client_id){
            if (auth()->user()->branch_id) {
                return $query->where('id', auth()->user()->branch_id)
                             ->orderBy('id','desc');
            }
            else{
                return $query->where('client_id', auth()->user()->client_id)
                             ->orderBy('id','desc');
            }    
        }
        
        return $query;
        
    }

   
}
