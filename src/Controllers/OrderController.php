<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use App\Http\Controllers\Controller;
use ConfrariaWeb\PhotoSale\Requests\StoreOrderPaymentRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $data['orders'] = resolve('OrderService')->all();
        return view('photoSale::orders.index', $data);
    }

    public function show($id)
    {
        $data['listCreditCardBrands'] = resolve('CreditCardService')->listCreditCardBrands();
        $data['order'] = resolve('OrderService')->find($id);
        return view('photoSale::orders.show', $data);
    }

    public function edit($id)
    {
        $data['order'] = resolve('OrderService')->find($id);
        return view('photoSale::orders.edit', $data);
    }

    public function processPayment(StoreOrderPaymentRequest $request, $id)
    {
        $order = resolve('OrderService')->find($id);
        $data = $request->all();
        $payment = resolve('OrderService')
            ->setUser($order->user)
            ->setOrder($order)
            ->setData($data)
            ->convertInput()
            ->payment();
        return redirect()->route('orders.show', ['order' => $id])
            ->with(['status' => $payment['message']]);
    }

    public function cancelOrder($id)
    {
        $orderCancel = resolve('OrderService')
            ->setId($id)
            ->cancel();
        return back()->withInput()->with(['status' => $orderCancel['message']]);
    }

    public function generateFiles($id)
    {
        $generateFiles = resolve('OrderService')
            ->setId($id)
            ->generateFiles();
        return back()->withInput()->with(['status' => $generateFiles['message']]);
    }
}
