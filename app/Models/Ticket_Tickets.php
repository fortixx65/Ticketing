<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Projects;
use App\Models\Ticket_Types;
use App\Models\Ticket_Priority;


class Ticket_Tickets extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id', 
        'project_id',
        'content',
        'status',
        'type_id',
        'priority_id',
        'count',
        'created_at',
        'updated_at',
    ];

    protected $with =[
        'user',
        'type',
        'project',
        'priority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function type()
    {
        return $this->belongsTo(Ticket_Types::class);
    }

    public function priority()
    {
        return $this->belongsTo(Ticket_Priority::class);
    }

    public function status()
    {
        if($this->status == 0){
            return "New";
        }
        elseif($this->status == 1){
            return "En cours";
        }   
        elseif($this->status == 2){
            return "Clos";
        }
        else{
            return "Erreur";
        }
    }
}