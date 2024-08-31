<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyAttendanceScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_genis_id',
        'month',
        'score'
    ];
}
