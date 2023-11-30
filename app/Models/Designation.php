<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allScopes;

class Designation extends Model
{
    use HasFactory,allScopes;
    protected $guarded=[];
}
