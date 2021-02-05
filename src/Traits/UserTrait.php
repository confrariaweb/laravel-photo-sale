<?php

namespace ConfrariaWeb\PhotoSale\Traits;

use ConfrariaWeb\PhotoSale\Models\Address;
use ConfrariaWeb\PhotoSale\Models\CreditCard;
use ConfrariaWeb\PhotoSale\Models\Order;
use ConfrariaWeb\PhotoSale\Models\Photo;
use ConfrariaWeb\PhotoSale\Models\Socialite;

trait UserTrait
{
    public function socialites()
    {
        return $this->hasMany(Socialite::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function creditCard()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
