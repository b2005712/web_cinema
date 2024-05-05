<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTheater extends Model
{
    use HasFactory;

    protected $table = 'staff_theater';

    protected $fillable = [
        'user_id',
        'theater_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function theater()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }
}
