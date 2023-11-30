<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;

class Source extends Model
{
    use HasFactory,allScopes;
    protected $fillable = ['sources','client_id'];
    protected $guarded = [];
    public function client(){
        return $this->belongsTo('Client::class');
    }
}
