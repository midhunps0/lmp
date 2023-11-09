<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','name','type','status','body','payload'];
    public static array $templateType=['welcome email','followup email',
                                    'proposal template','SMS template',
                                    'Survey tempalte'];
    public function clients(){
        return $this->belongsTo(Client::class);
    }
}
