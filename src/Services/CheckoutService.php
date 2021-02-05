<?php

namespace ConfrariaWeb\PhotoSale\Services;

use ConfrariaWeb\PhotoSale\Models\Plan;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{

    public function store($data)
    {
        $addressData = [];
        $orderData = [];
        $user = Auth::user();
        $plan = Plan::find($data['plan']);
        $addressData['zipcode'] = $data['address-zipcode'];
        $addressData['country'] = $data['address-country'];
        $addressData['state'] = $data['address-state'];
        $addressData['city'] = $data['address-city'];
        $addressData['district'] = $data['address-district'];
        $addressData['street'] = $data['address-street'];
        $addressData['number'] = $data['address-number'];
        $addressData['complement'] = $data['address-complement'] ?? NULL;
        $addressData['note'] = $data['address-note'] ?? NULL;
        $address = $user->addresses()->firstOrCreate($addressData);
        if (!$address) {
            return $this->errorReturn('Erro ao tentar cadastrar o endereço');
        }

        $orderData['creditcard'] = $data['payment-type']?? NULL;
        $orderData['paymentType'] = $data['payment-type']?? 'CreditCard';
        $orderData['securityCode'] = $data['card-security-code']?? NULL;
        $orderData['brand'] = $data['card-brand']?? NULL;
        $orderData['cardToken'] = NULL;
        $orderData['expirationDate'] = $data['card-expiration-date']?? NULL;
        $orderData['cardNumber '] = $data['card-number']?? NULL;
        $orderData['holder'] = $data['card-name']?? NULL;
        $orderData['saveCard'] = $data['card-save']?? TRUE;

        $order = resolve('OrderService')
            ->setPlan($plan)
            ->setUser($user)
            ->setData($orderData)
            ->setAddress($address)
            ->setPayment(true)
            ->create();

        $returnCode = $order['orderPayment']['returnPayment']['returnCode'];
        $returnMessage = $order['orderPayment']['returnPayment']['returnMessage'];
        return array_merge([
            'error' => in_array($returnCode, [4, 6])? false : true,
            'message' => $returnMessage?? 'Pedido efetuado com sucesso'
        ], $order);
    }

    /**
     * @param $error
     * @return array
     */
    function errorReturn($error)
    {
        $error = is_array($error) ? $error : ['error' => true, 'message' => $error];
        return $error;
    }

}
