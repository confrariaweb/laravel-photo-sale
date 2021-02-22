<?php

namespace ConfrariaWeb\PhotoSale\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('user_photo', function (Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }

    public function socialite()
    {
        return $this->belongsTo(Socialite::class);
    }
}
