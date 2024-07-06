<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaifuImage extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'path'];
}
