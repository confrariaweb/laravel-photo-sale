<!--div class="row mb-3">
    <div class="col-12 form-group">
        <label for="creditcard">Cartões salvos</label>
        <select class="form-control" name="creditcard" id="creditcard">
            <option value="">Novo Cartão</option>
        </select>
    </div>
</div-->
<div class="row mb-3">
    <div class="col-12 form-group">
        <label for="card-holder">Nome no cartão</label>
        <input type="text" class="form-control" name="card-holder" id="card-holder" placeholder="" required="" value="{{ old('card-holder') }}">
        <small class="text-muted">Nome completo conforme exibido no cartão</small>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12 form-group">
        <label for="card-number">Numero do cartão</label>
        <input type="text" class="form-control credit_card_number" name="card-number" id="card-number" placeholder="" required="" value="{{ old('card-number') }}">
    </div>
</div>
<div class="row mb-3">
    <div class="col-4 form-group">
        <label for="card-brand">Bandeira do cartão</label>
        <select class="form-control" name="card-brand" id="card-brand" required="">
            @foreach($listCreditCardBrands as $kflag => $flag)
                <option value="{{ $kflag }}">{{ $flag }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 form-group">
        <label for="card-expiration-date">Data de validade</label>
        <input type="text" class="form-control date" name="card-expiration-date" id="card-expiration-date" placeholder="Data de validade" required="" value="{{ old('card-expiration-date') }}">
    </div>
    <div class="col-4 form-group">
        <label for="card-security-code">CVV</label>
        <input type="number" class="form-control credit_card_security_code" maxlength="3" name="card-security-code" id="card-security-code" placeholder="Cód. segurança" required="" value="{{ old('card-security-code') }}">
    </div>
</div>