<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoiment extends Model
{
    use HasFactory;
    public function leads(){
        return $this->belongsTo(Lead::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'attending_person_id');
    }
}
