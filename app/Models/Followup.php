<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function lead(){
        return $this->belongsTo(Lead::class);
    }
   

    public function CreatedBy(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function CarriedOutBy(){
        return $this->belongsTo(User::class,'carried_out_by');
    }
   
}
