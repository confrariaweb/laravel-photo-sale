<?php

namespace ConfrariaWeb\PhotoSale\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment-type' => 'required',
            'card-security-code' => 'required_without_all:card-token',
            'card-brand' => 'required_without_all:card-token',
            'card-token' => 'required_without_all:card-security-code,card-brand,card-expiration-date,card-number,card-holder',
            'card-expiration-date' => 'required_without_all:card-token',
            'card-number' => 'required_without_all:card-token',
            'card-holder' => 'required_without_all:card-token',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment-type.required' => 'O tipo de pagamento é obrigatório',
            'card-security-code.required_without_all' => 'O código de segurança é obrigatório',
            'card-brand.required_without_all' => 'A bandeira do cartão é obrigatória',
            'card-token.required_without_all' => 'Seu token não existe ou é invalido',
            'card-expiration-date.required_without_all' => 'Data de expiração do cartão é obrigatória',
            'card-number.required_without_all' => 'O numero do cartão é obrigatório',
            'card-holder.required_without_all' => 'O nome impresso no cartão é obrigatório',
        ];
    }

}
