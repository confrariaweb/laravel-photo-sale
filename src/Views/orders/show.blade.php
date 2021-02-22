<x-template-layout>
    <div class="row">
        <div class="col-6">
            <h4>Pedido {{ $order->plan->name }} <small>[{{ $order->status->name }}]</small></h4>
        </div>
        <div class="col-6 text-right text-end">
            <div class="btn-group btn-group-sm float-right" role="group" aria-label="Basic">
                <div class="btn-group" role="group" aria-label="">
                    <a href="#" class="btn btn-secondary">Voltar</a>
                    @if(!$order->paid())
                        <button type="button"
                                class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalProcessPayment">
                            Efetuar pagamento
                        </button>
                    @elseif(auth()->user()->isAdmin())
                        <button type="button"
                                onclick="event.preventDefault(); document.getElementById('formGenerateFiles-{{ $order->id }}').submit();"
                                class="btn btn-success">Gerar arquivos
                        </button>
                        <form id="formGenerateFiles-{{ $order->id }}" method="POST"
                              action="{{ route('orders.generate.files', ['order' => $order->id]) }}">
                            @csrf
                        </form>
                    @endif

                    <a href="#" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="orders-row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Endereço de entrega
                </div>
                <div class="card-body">
                    Rua {{ $order->address->street }},
                    {{ $order->address->number }},
                    {{ $order->address->complement }}
                    <br>
                    Bairro {{ $order->address->district }},
                    Cidade {{ $order->address->city }},
                    Estado {{ $order->address->state }},
                    País {{ $order->address->country }}
                    <br>
                    CEP: {{ $order->address->zipcode }}
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    Fotos selecionadas
                </div>
                <div class="card-body">
                        @forelse ($order->photos as $photo)
                            <img src="{{ $photo->source }}" class="img-thumbnail" width="100" height="100">
                        @empty
                            <p>Nenhuma foto selecionada ainda</p>
                        @endforelse
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    Detalhes do pedido
                </div>
                <div class="card-body">
                    Valor: {{ number_format($order->price, 2, ',', '.') }}
                    ({{ $order->paid()? 'Pago' : 'Pagamento pendente' }})
                    <br>
                    Criado: {{ $order->created_at->format('d/m/Y') }}
                    <br>
                    Atualizado: {{ $order->updated_at->format('d/m/Y') }}
                    <br>
                    Plano: {{ $order->plan->name }}
                    <br>
                    Status: {{ $order->status->name }}
                    <br>
                    Recorrente: {{ $order->recurrent? 'Sim' : 'Não' }}
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    Pagamentos
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @forelse ($order->payments as $payment)
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ __($payment->type) }}</h5>
                                    <small>{{ $payment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">
                                    {{ $payment->return_message }}
                                </p>
                            </a>
                        @empty
                            <p>No payments</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            <h4 class="">Informações importantes</h4>
            <p>Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Paisis, filhis,
                espiritis santis. Leite de capivaris, leite de mula manquis sem cabeça. Praesent vel viverra nisi.
                Mauris aliquet nunc non turpis scelerisque, eget.</p>
            <p>Per aumento de cachacis, eu reclamis. Viva Forevis aptent taciti sociosqu ad litora torquent.
                Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis. Todo mundo vê os porris que
                eu tomo, mas ninguém vê os tombis que eu levo!</p>
            <p>Interagi no mé, cursus quis, vehicula ac nisi. Quem num gosta di mim que vai caçá sua turmis! Mais vale
                um bebadis conhecidiss, que um alcoolatra anonimis. Manduma pindureta quium dia nois paga.</p>
            <p>Atirei o pau no gatis, per gatis num morreus. Diuretics paradis num copo é motivis de denguis. Em pé sem
                cair, deitado sem dormir, sentado sem cochilar e fazendo pose. Si num tem leite então bota uma pinga aí
                cumpadi!</p>
            <p>Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis. Admodum accumsan
                disputationi eu sit. Vide electram sadipscing et per. Praesent malesuada urna nisi, quis volutpat erat
                hendrerit non. Nam vulputate dapibus. Casamentiss faiz malandris se pirulitá.</p>
        </div>
    </div>
    @include('photoSale::modals.process-payment')
</x-template-layout>


