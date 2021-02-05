<?php

namespace ConfrariaWeb\PhotoSale\Services;

use ConfrariaWeb\PhotoSale\Models\CreditCard;
use Illuminate\Support\Facades\Auth;

class CreditCardService
{

    public function __construct()
    {
        //
    }

    public function find($id)
    {
        return CreditCard::find($id);
    }

    public function create($data)
    {
        $user = Auth::user();
        $creditCard = $user->creditCard()->create($data);
        return $creditCard;
    }

    public function tokenizeCard($data)
    {
        return resolve('CieloService')
            ->setCustomerName($data['customerName'])
            ->setCardNumber($data['cardNumber'])
            ->setHolder($data['holder'])
            ->setExpirationDate($data['expirationDate'])
            ->setBrand($data['brand'])
            ->tokenizeCard();
    }

    public function listCreditCardBrands()
    {
        return resolve('CieloService')->listCreditCardBrands();
    }

}
