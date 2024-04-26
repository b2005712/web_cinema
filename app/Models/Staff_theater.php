<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_theater extends Model
{
    use HasFactory;

    protected $table = 'staff_theater';

    protected $fillable = [
        'user_id',
        'user_theater',
    ];
}
