<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use ConfrariaWeb\PhotoSale\Models\CreditCard;
use ConfrariaWeb\PhotoSale\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('checkout');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['creditcards'] = CreditCard::all();
        //$data['listCreditCardFlags'] = resolve('CreditCardService')->listCreditCardBrands();
        return view('photoSale::user', $data);
    }

    public function update(Request $request, $id)
    {

    }

    public function tokenizeCardAjax(Request $request)
    {
        $customerName = $request->holder;
        $cardNumber = $request->card_number;
        $holder = $request->holder;
        $expirationDate = $request->expiration_date;
        $brand = $request->brand;
        $SecurityCode = $request->security_code;

        $tokenizeCard = resolve('CreditCardService')
            ->tokenizeCard($customerName, $cardNumber, $holder, $expirationDate, $brand, $SecurityCode);
        return response()->json($tokenizeCard);
    }

    public function checkout()
    {
        $data['user'] = Auth::user();
        $data['plans'] = Plan::all();
        $data['creditcards'] = CreditCard::all();
        $data['listCreditCardFlags'] = resolve('CreditCardService')->listCreditCardBrands();
        return view('photoSale::checkout', $data);

    }

    public function checkoutStoreAjax(Request $request)
    {
        $formItems = $request->all();
        $checkout = resolve('CheckoutService')
            ->checkout($formItems);
        return response()->json($checkout);
    }

    public function paymentInformation()
    {
        $id = Auth::id();
        $data['user'] = User::find($id);
        $data['creditcards'] = CreditCard::all();
        $data['listCreditCardFlags'] = resolve('CreditCardService')->listCreditCardBrands();
        return view('photoSale::payment-information', $data);
    }

    public function profile()
    {
        return $this->edit(Auth::id());
    }
}
