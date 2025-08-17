<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Projects;

class Projects_Permissions extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'permission_id',
        'created_at',
        'updated_at',
    ];

    protected $with =[
        'procject',
        'permission',
    ];


    public function procject()
    {
        return $this->belongsTo(Projects::class);
    }

    // public function permission()
    // {
    //     return $this->belongsTo(Permissions::class);
    // }
}