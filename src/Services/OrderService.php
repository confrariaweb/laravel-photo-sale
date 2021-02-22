<?php

namespace ConfrariaWeb\PhotoSale\Services;

use ConfrariaWeb\PhotoSale\Models\Order;
use ConfrariaWeb\PhotoSale\Models\OrderStatus;

class OrderService
{

    private $address;
    private $data;
    private $id;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    public function convertInput($orderData = [])
    {
        $data = $this->getData();
        $orderData['paymentType'] = $data['payment-type'] ?? NULL;
        $orderData['securityCode'] = $data['card-security-code'] ?? NULL;
        $orderData['brand'] = $data['card-brand'] ?? NULL;
        $orderData['cardToken'] = $data['card-token'] ?? NULL;
        $orderData['expirationDate'] = $data['card-expiration-date'] ?? NULL;
        $orderData['cardNumber '] = $data['card-number'] ?? NULL;
        $orderData['holder'] = $data['card-holder'] ?? NULL;
        $orderData['saveCard'] = $data['card-save'] ?? TRUE;
        $this->setData($orderData);
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
        $orderData['code'] = uniqid(rand());
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

    public function cancel()
    {
        $id = $this->getId();
        $order = $this->find($id);
        $status = OrderStatus::firstOrCreate(
            ['slug' => 'canceled'],
            ['name' => 'Cancelado']
        );
        $order->update(['done' => true, 'status_id' => $status->id]);
        return [
            'error' => false,
            'message' => 'O pedido foi cancelado com sucesso'
        ];
    }

    public function payment()
    {
        $user = $this->getUser();
        $order = $this->getOrder();
        $data = $this->getData();
        $orderData['customerName'] = $user->name;
        $data['paymentValue'] = str_replace('.', '', $order->price);
        $paymentCielo = $this->paymentCielo($order, $data);
        $paymentData['type'] = $paymentCielo['type'] ?? NULL;
        $paymentData['paid'] = !$paymentCielo['error'];
        $paymentData['return_code'] = $paymentCielo['returnCode'] ?? NULL;
        $paymentData['return_message'] = $paymentCielo['returnMessage'] ?? NULL;
        $paymentData['return'] = $paymentCielo['return'] ?? NULL;
        $orderPayment = $order->payments()->create($paymentData);
        return [
            'error' => $paymentCielo['error'],
            'message' => $paymentData['return_message'],
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

    public function selectPhotos()
    {
        $id = $this->getId();
        $order = $this->find($id);
        $photos_count = $order->photos()->count();
        $plan_photo_amount = $order->plan->photo_amount;
        $take = $plan_photo_amount - $photos_count;
        $photos = resolve('PhotoService')
            ->take($take)
            ->inRandomOrder()
            ->likeAll();
        if ($photos->count() > 0) {
            $idsPhotos = $photos->pluck('id');
            $order->photos()->attach($idsPhotos);
        }
        return [
            'error' => false,
            'message' => 'Fotos selecionadas com sucesso',
            'photos' => $photos
        ];
    }

    public function generateFiles()
    {
        $selectPhotos = $this->selectPhotos();
        return [
            'error' => false,
            'message' => 'Fotos geradas com sucesso'
        ];
    }
}
