<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permissions_Roles;
use App\Models\Roles_Permissions;
use Illuminate\Support\Facades\Auth;

class Roles extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'color',
        'created_at',
        'updated_at',
    ];

    public static function hasRoutes($route)
    {
        if (Auth::user()->role_id == 1) {
            return true;
        }
    
        if(Permissions_Roles::where('route', $route)->exists()) {
            $user = Auth::user();
            $perm = Permissions_Roles::where('route', $route)->first();
            if (Roles_Permissions::where('permission_id', $perm->id)->where('role_id', $user->role_id)->exists()) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return true;
        }
    }

}
