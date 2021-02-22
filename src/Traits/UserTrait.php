<?php

namespace ConfrariaWeb\PhotoSale\Traits;

use ConfrariaWeb\PhotoSale\Models\Address;
use ConfrariaWeb\PhotoSale\Models\CreditCard;
use ConfrariaWeb\PhotoSale\Models\Order;
use ConfrariaWeb\PhotoSale\Models\Photo;
use ConfrariaWeb\PhotoSale\Models\Socialite;
use Illuminate\Support\Facades\Config;

trait UserTrait
{

    public function isAdmin()
    {
        return in_array($this->email, Config::get('cw_photo_sale.administrator.emails'));
    }
    public function socialites()
    {
        return $this->hasMany(Socialite::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function creditCards()
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
