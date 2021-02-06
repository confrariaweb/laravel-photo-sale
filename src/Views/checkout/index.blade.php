<x-template-layout>
    <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="row">
            <div class="col-4">
                <h4>Checkout</h4>
            </div>
            <div class="col-8 text-right">
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <div class="btn-group" role="group" aria-label="">
                        <a href="#" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-success">Comprar</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @include('photoSale::forms.plans')
        <hr>
        <div class="row" id="address-row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h4>Endereço de entrega</h4>
                    </div>
                </div>
                @include('photoSale::forms.address')
            </div>
        </div>
        <hr>
        <div class="row" id="">
            <div class="col-12">
                <h4>Forma de pagamento</h4>
            </div>
        </div>
        <div class="row" id="payment-method-row">
            <div class="d-block col-4">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment-method" type="radio" class="custom-control-input" checked=""
                           required="">
                    <label class="custom-control-label" for="credit">Cartão de crédito</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment-method" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="debit">Cartão de débito</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="payment-method" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="paypal">Boleto</label>
                </div>
            </div>
            <div class="d-block col-8">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Desejo que este plano seja recorrente</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Salvar estas informações de pagamento para futuras compras</label>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 form-group">
                <label for="creditcard">Cartão</label>
                <select class="form-control" name="creditcard" id="creditcard">
                    <option value="">Novo Cartão</option>
                    @foreach($creditcards as $cc_k => $cc_v)
                        <option value="{{ $cc_v->id }}">{{ $cc_v->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @include('photoSale::forms.card')
        <hr>
        <div class="row" id="submit-row">
            <div class="col-12">
                <button type="submit" class="btn btn-success w-100">Comprar</button>
            </div>
        </div>
        <hr>
        <div class="row" id="notes-row">
            <div class="col-12">
                <h2>Informações</h2>
                <p>Mussum Ipsum, cacilds vidis litro abertis. Suco de cevadiss deixa as pessoas mais interessantis.
                    Paisis, filhis, espiritis santis. Admodum accumsan disputationi eu sit. Vide electram sadipscing et
                    per. Mais vale um bebadis conhecidiss, que um alcoolatra anonimis.</p>

                <p>Pra lá , depois divoltis porris, paradis. Si num tem leite então bota uma pinga aí cumpadi! Nullam
                    volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Manduma pindureta
                    quium dia nois paga.</p>

                <p>Leite de capivaris, leite de mula manquis sem cabeça. In elementis mé pra quem é amistosis quis leo.
                    Copo furadis é disculpa de bebadis, arcu quam euismod magna. Posuere libero varius. Nullam a nisl ut
                    ante blandit hendrerit. Aenean sit amet nisi.</p>

                <p>Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. Delegadis gente finis, bibendum
                    egestas augue arcu ut est. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu
                    levo! Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.</p>

                <p>Praesent malesuada urna nisi, quis volutpat erat hendrerit non. Nam vulputate dapibus. Interessantiss
                    quisso pudia ce receita de bolis, mais bolis eu num gostis. Quem manda na minha terra sou euzis! Não
                    sou faixa preta cumpadi, sou preto inteiris, inteiris.</p>

            </div>
        </div>
    </form>
</x-template-layout>


