<?php

namespace ConfrariaWeb\PhotoSale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'driver',
        'driver_id',
        'user_id',
    ];
}
