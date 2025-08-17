<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Ticket_Tickets;
use App\Models\Ticket_Messages;
use App\Models\Projects;

class Ticket_Times extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'content',
        'type',
        'user_id',
        'ticket_id',
        'message_id',
        'project_id',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'user',
        'ticket',
        'message',
        'project',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket_Tickets::class);
    }

    public function message()
    {
        return $this->belongsTo(Ticket_Messages::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }
}