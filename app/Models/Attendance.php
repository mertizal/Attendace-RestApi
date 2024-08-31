<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orion\Concerns\DisablePagination;

class Attendance extends Model
{
    use DisablePagination;
    use HasFactory;
    protected $fillable = [
        'user_genis_id',
        'date',
        'status',
        'reason'
    ];
}
