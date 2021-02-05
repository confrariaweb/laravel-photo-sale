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

    public function edit($id){
        $data['order'] = resolve('OrderService')->find($id);
        return view('photoSale::orders.edit', $data);
    }

}
