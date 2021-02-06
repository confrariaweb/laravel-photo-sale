<?php

namespace ConfrariaWeb\PhotoSale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'socialite_id',
        'user_id',
        'idphoto',
        'name',
        'dislike'
    ];

    public function socialite()
    {
        return $this->belongsTo(Socialite::class);
    }
}
