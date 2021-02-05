<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>{{ $user->name }}</h4>
        </div>
        <div class="col-8 text-right">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <div class="btn-group" role="group" aria-label="">
                    <a href="#" class="btn btn-secondary">Voltar</a>
                    <a href="#" class="btn btn-success">Salvar</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="user-row">
        <div class="col-12">
            <div class="row">
                <h4 class="col-12">Informações de pagamento</h4>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <h5 class="col-12">Cartões cadastrados</h5>
                        <div class="col-12 mt-3">
                            <ul class="list-group" id="brand-list">
                                @forelse($creditcards as $creditcard)
                                    <li class="list-group-item">
                                        {{ $creditcard->title }}
                                        <div class="btn-group float-right" role="group" aria-label="Basic">
                                            <button class="btn btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('formDestroyCreditCard-{{ $creditcard->id }}').submit();">
                                                <span class="material-icons">delete</span>
                                            </button>
                                            <form id="formDestroyCreditCard-{{ $creditcard->id }}" method="POST"
                                                  action="{{ route('creditcards.destroy', ['creditcard' => $creditcard->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="creditcard" value="{{ $creditcard->id }}">
                                            </form>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item not-creditcard">Nenhum cartão cadastrado</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <form id="tokenize-new-form-card" action="{{ route('users.tokenizecard.ajax') }}">
                        <div class="row">
                            <h5 class="col-12">Add novo crédito</h5>
                            <div class="col-12 mt-3">
                                <label for="cc-name">Nome no cartão</label>
                                <input type="text" class="form-control" name="holder" id="holder" placeholder=""
                                       required="">
                                <small class="text-muted">Nome completo conforme exibido no cartão</small>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="cc-number">Numero do cartão</label>
                                <input type="text" class="form-control" name="card_number" id="card_number"
                                       placeholder="" required="">
                            </div>

                            <div class="col-4 mt-3">
                                <label for="cc-expiration">Bandeira do cartão</label>
                                <select class="form-control" name="brand" id="brand"
                                        placeholder="Bandeira do cartão" required="">
                                    @foreach($listCreditCardFlags as $kflag => $flag)
                                        <option value="{{ $kflag }}">{{ $flag }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 mt-3">
                                <label for="cc-expiration">Data de validade</label>
                                <input type="text" class="form-control" name="expiration_date" id="expiration_date"
                                       placeholder="Data de validade" required="">
                            </div>
                            <div class="col-4 mt-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" name="security_code" id="security_code"
                                       placeholder="Cód. segurança" required="">
                            </div>
                            <div class="col-12 mt-3">
                                <button class="w-100 btn btn-primary" type="submit">Salvar este
                                    cartão
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-template-layout>


