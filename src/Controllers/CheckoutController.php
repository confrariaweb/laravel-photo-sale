<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use App\Http\Controllers\Controller;
use ConfrariaWeb\PhotoSale\Models\CreditCard;
use ConfrariaWeb\PhotoSale\Models\Plan;
use ConfrariaWeb\PhotoSale\Requests\StoreCheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function index()
    {
        $data['user'] = Auth::user();
        $data['plans'] = Plan::all();
        $data['creditcards'] = CreditCard::all();
        $data['listCreditCardBrands'] = resolve('CreditCardService')->listCreditCardBrands();
        return view('photoSale::checkout.index', $data);
    }

    public function store(StoreCheckoutRequest $request)
    {
        $formItems = $request->all();
        $checkout = resolve('CheckoutService')->store($formItems);
        $orderId = $checkout['order']->id;
        return redirect()->route('orders.edit', ['order' => $orderId]);
    }

    public function storeAjax(StoreCheckoutRequest $request)
    {
        $formItems = $request->all();
        $checkout = resolve('CheckoutService')->store($formItems);
        return response()->json($checkout);
    }

}
