<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'user_id',
        'status',
        'code',
        'hasPaid',
        'payment',
        'totalPrice',
        'status',
        'created_at'
    ];

    public function ticketSeats()
    {
        return $this->hasMany(TicketSeat::class, 'ticket_id', 'id');
    }

    public function ticketCombos()
    {
        return $this->hasMany(TicketCombo::class, 'ticket_id', 'id');
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class,'id','schedule_id');
    }

}
