<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;
use App\Models\Permissions_Roles;
use App\Models\Roles_Permission;

class Roles_Permissions extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'permission_id',
        'created_at',
        'updated_at',
    ];

    protected $with =[
        'role',
        'permission',
    ];


    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permissions_Roles::class);
    }
}