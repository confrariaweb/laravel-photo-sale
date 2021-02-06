<?php

namespace ConfrariaWeb\PhotoSale\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'type',
        'paid',
        'return_code',
        'return_message',
        'return'
    ];

    protected $casts = [
        'paid' => 'boolean',
        'return' => 'collection',
    ];
}
