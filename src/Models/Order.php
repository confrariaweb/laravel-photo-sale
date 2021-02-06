<?php

namespace ConfrariaWeb\PhotoSale\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status_id',
        'address_id',
        'parent_id',
        'plan_id',
        'code',
        'price',
        'recurrent'
    ];

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
