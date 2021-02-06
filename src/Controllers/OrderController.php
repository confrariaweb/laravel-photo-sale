<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use App\Http\Controllers\Controller;
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
        $data['order'] = resolve('OrderService')->find($id);
        return view('photoSale::orders.show', $data);
    }

    public function edit($id)
    {
        $data['order'] = resolve('OrderService')->find($id);
        return view('photoSale::orders.edit', $data);
    }

    public function processPayment($id)
    {
        /*$order = resolve('OrderService')->find($id);
        $data = [];
        $payment = resolve('OrderService')
            ->setUser($order->user)
            ->setOrder($order)
            ->setData($data)
            ->payment();
        dd($order);*/
        return redirect()->route('orders.show', ['order' => $id]);
    }

}
