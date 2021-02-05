<div class="form-row">
    <div class="col-12 form-group">
        <label for="card-name">Nome no cartão</label>
        <input type="text" class="form-control" name="card-name" id="card-name" placeholder="" required="" value="{{ old('card-name') }}">
        <small class="text-muted">Nome completo conforme exibido no cartão</small>
    </div>
</div>
<div class="form-row">
    <div class="col-12 form-group">
        <label for="card-number">Numero do cartão</label>
        <input type="text" class="form-control" name="card-number" id="card-number" placeholder="" required="" value="{{ old('card-number') }}">
    </div>
</div>
<div class="form-row">
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
        <input type="text" class="form-control" name="card-expiration-date" id="card-expiration-date" placeholder="Data de validade" required="" value="{{ old('card-expiration-date') }}">
    </div>
    <div class="col-4 form-group">
        <label for="card-security-code">CVV</label>
        <input type="text" class="form-control" name="card-security-code" id="card-security-code" placeholder="Cód. segurança" required="" value="{{ old('card-security-code') }}">
    </div>
</div>