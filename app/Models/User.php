<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Ynotz\AccessControl\Models\Permission;
use Modules\Ynotz\AccessControl\Traits\WithRoles;
use Modules\Ynotz\MediaManager\Traits\OwnsMedia;
use App\Scopes\allScopes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, WithRoles, OwnsMedia, allScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'client_id',
        'branch_id',
        'designation_id',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getMediaStorage(): array
    {
        return [
            'profile_picture' => $this->storageLocation(
                disk: 'local',
                folder: 'public/images/profile_pictures'
            ),
        ];
    }
    public function client(){
        return $this->belongsTo(Client::class,'managing_person_id');
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function leads(){
        return $this->hasMany(Lead::class);
    }
    public function followups(){
        return $this->hasMany(Followup::class);
    }
   
   

   
}
