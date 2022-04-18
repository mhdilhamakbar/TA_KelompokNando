<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'room_id',
        'class',
        'marker_collect_at',
        'marker_return_at',
        'attendance_collect_at',
        'attendance_return_at',
    ];
}
