<?php

namespace ConfrariaWeb\PhotoSale\Services;

use ConfrariaWeb\PhotoSale\Models\Order;

class OrderService
{

    private $address;
    private $data;
    private $order;
    private $payment;
    private $plan;
    private $user;

    /**
     * OrderService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @param mixed $plan
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function find($id)
    {
        return Order::find($id);
    }

    public function all()
    {
        return Order::all();
    }

    public function create()
    {
        $payment = $this->getPayment();
        $user = $this->getUser();
        $plan = $this->getPlan();
        $address = $this->getAddress();
        $orderData['price'] = $plan->price;
        $orderData['plan_id'] = $plan->id;
        $orderData['address_id'] = $address->id;
        $orderData['status_id'] = 1;
        $orderData['code'] = uniqid(rand(), true);
        $order = $user->orders()->create($orderData);
        if (!$order) {
            return $this->errorReturn('Erro ao tentar gerar o pedido');
        }
        $r['order'] = $order;
        if ($payment) {
            $this->setOrder($order);
            $r['orderPayment'] = $this->payment();
        }
        return $r;
    }

    public function payment()
    {
        $user = $this->getUser();
        $order = $this->getOrder();
        $data = $this->getData();
        $orderData['customerName'] = $user->name;
        $data['paymentValue'] = str_replace('.', '', $order->price);
        $paymentCielo = $this->paymentCielo($order, $data);
        $paymentData['type'] = $paymentCielo['type'];
        $paymentData['paid'] = !$paymentCielo['error'] && in_array($paymentCielo['returnCode'], [4, 6]);
        $paymentData['return_code'] = $paymentCielo['returnCode'] ?? NULL;
        $paymentData['return_message'] = $paymentCielo['returnMessage'] ?? NULL;
        $paymentData['return'] = $paymentCielo['return'] ?? NULL;
        $orderPayment = $order->payments()->create($paymentData);
        return [
            'returnPayment' => $paymentCielo,
            'payment' => $orderPayment
        ];
    }

    public function paymentCielo($order, $data)
    {
        $orderCode = $order->code;
        $creditcardId = $data['creditcard'] ?? NULL;
        $customerName = $data['customerName'] ?? $order->user->name;
        $paymentValue = str_replace('.', '', $data['paymentValue'] ?? $order->price);
        $paymentType = $data['paymentType'] ?? NULL;
        $securityCode = $data['securityCode'] ?? NULL;
        $brand = $data['brand'] ?? NULL;
        $cardToken = $data['cardToken'] ?? NULL;
        $expirationDate = $data['expirationDate'] ?? NULL;
        $cardNumber = $data['cardNumber '] ?? NULL;
        $holder = $data['holder'] ?? NULL;
        $saveCard = $data['saveCard'] ?? FALSE;
        $recurrentPayment = $data['recurrentPayment'] ?? FALSE;
        $recurrentPaymentInterval = $data['recurrentPaymentInterval'] ?? NULL;
        if ($creditcardId) {
            $creditcard = resolve('CreditCardService')->find($creditcardId);
            $cardToken = $creditcard->token ?? NULL;
            $brand = $creditcard->brand ?? NULL;
            $securityCode = $creditcard->security_code ?? NULL;
        }

        return resolve('CieloService')
            ->setOrderCode($orderCode)
            ->setCustomerName($customerName)
            ->setPaymentValue($paymentValue)
            ->setPaymentType($paymentType)
            ->setSecurityCode($securityCode)
            ->setBrand($brand)
            ->setCardToken($cardToken)
            ->setExpirationDate($expirationDate)
            ->setCardNumber($cardNumber)
            ->setHolder($holder)
            ->setSaveCard($saveCard)
            ->setRecurrentPayment($recurrentPayment)
            ->setRecurrentPaymentInterval($recurrentPaymentInterval)
            ->payment();
    }

    function errorReturn($error)
    {
        $error = is_array($error) ? $error : ['error' => true, 'message' => $error];
        return $error;
    }
}
