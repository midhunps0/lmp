<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;

class Tag extends Model
{
    use HasFactory,allScopes;
    protected $guarded=[];
    public function tags(){
        return $this->belongsToMany(Tag::class,'clients_tags');
    }
}
