<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orion\Concerns\DisablePagination;

class UserGeni extends Model
{
    use HasFactory;
    use DisablePagination;
    protected $fillable = [
        'discord_id',
        'name',
        'email'
    ];
}
