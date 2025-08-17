<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;
use App\Models\Projects;

class Projects_Acces extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'role_id',
        'created_at',
        'updated_at',
    ];

    protected $with =[
        'project',
        'role',
    ];


    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}