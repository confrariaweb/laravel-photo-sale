<div class="row mb-3">
    <div class="d-block col-4">
        <div class="custom-control custom-radio">
            <input id="creditcard" value="creditcard" name="payment-type" type="radio" class="custom-control-input" checked=""
                   required="">
            <label class="custom-control-label" for="credit">Cartão de crédito</label>
        </div>
    </div>
    <div class="d-block col-4">
        <div class="custom-control custom-radio">
            <input id="debitcard" value="debitcard" name="payment-type" type="radio" class="custom-control-input" required="">
            <label class="custom-control-label" for="debit">Cartão de débito</label>
        </div>
    </div>
    <div class="d-block col-4">
        <div class="custom-control custom-radio">
            <input id="boleto" value="boleto" name="payment-type" type="radio" class="custom-control-input" required="">
            <label class="custom-control-label" for="boleto">Boleto</label>
        </div>
    </div>
</div>
@include('photoSale::forms.card')