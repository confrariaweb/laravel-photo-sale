<div class="form-row">
    <div class="form-group col-2">
        <label for="address-zipcode">CEP</label>
        <input type="text" class="form-control" id="address-zipcode" name="address-zipcode" placeholder="CEP" required="" value="{{ old('address-zipcode') }}">
    </div>
    <div class="form-group col-3">
        <label for="address-country">País</label>
        <input type="text" class="form-control" id="address-country" name="address-country" placeholder="País" required="" value="{{ old('address-country') }}">
    </div>
    <div class="form-group col-3">
        <label for="address-state">Estado</label>
        <input type="text" class="form-control" id="address-state" name="address-state" placeholder="Estado" required="" value="{{ old('address-state') }}">
    </div>
    <div class="form-group col-4">
        <label for="address-city">Cidade</label>
        <input type="text" class="form-control" id="address-city" name="address-city" placeholder="Cidade" required="" value="{{ old('address-city') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-3">
        <label for="address-district">Bairro</label>
        <input type="text" class="form-control" id="address-district" name="address-district" placeholder="Bairro" required="" value="{{ old('address-district') }}">
    </div>
    <div class="form-group col-4">
        <label for="address-street">Rua</label>
        <input type="text" class="form-control" id="address-street" name="address-street" placeholder="Nome da rua" required="" value="{{ old('address-street') }}">
    </div>
    <div class="form-group col-2">
        <label for="address-number">Numero</label>
        <input type="text" class="form-control" id="address-number" name="address-number" placeholder="Numero" required="" value="{{ old('address-number') }}">
    </div>
    <div class="form-group col-3">
        <label for="address-complement">Complemento</label>
        <input type="text" class="form-control" id="address-complement" name="address-complement" placeholder="Complemento" value="{{ old('address-complement') }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-12">
        <label for="address-note">Observação</label>
        <textarea class="form-control" id="address-note" name="address-note" placeholder="Observação">{{ old('address-note') }}</textarea>
    </div>
</div>