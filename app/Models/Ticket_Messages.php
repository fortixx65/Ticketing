<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use App\Models\Ticket_Tickets;

class Ticket_Messages extends Authenticatable
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
        'is_pinned',
        'is_locked',
        'user_id',
        'ticket_id',
        'time',
        'count',
        'created_at',
        'updated_at',
    ];

    protected $with =[
        'ticket',
        'user',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket_Tickets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function time()
    {
        if($this->time == 0){
            return "Null";
        }
        else
        {
            return $this->time . " min";
        }
    }
}