<div class="modal fade" id="modalProcessPayment" tabindex="-1" aria-labelledby="modalProcessPaymentLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProcessPaymentLabel">Processar pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formProcessPayment" method="POST"
                          action="{{ route('orders.process.payment', ['order' => $order->id]) }}">
                        @csrf
                        @include('photoSale::forms.payments-types')
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary"
                        onclick="event.preventDefault(); document.getElementById('formProcessPayment').submit();">
                    Enviar
                </button>
            </div>
        </div>
    </div>
</div>