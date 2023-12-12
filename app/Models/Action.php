<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;

class Action extends Model
{
    use HasFactory, allScopes;
    public function clients(){
        return $this->belongsTo(Client::class);
    }
}
