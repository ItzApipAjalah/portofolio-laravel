<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinecraftPlugin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'xp_level',
        'inventory',
        'online_time',
        'last_time_online',
        'first_time_online',
    ];

    protected $casts = [
        'inventory' => 'array',
        'last_time_online' => 'datetime',
        'first_time_online' => 'datetime',
    ];
}
