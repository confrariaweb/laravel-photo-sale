<x-template-layout>
    <div class="row">
        <div class="col-6">
            <h4>Pedido {{ $order->plan->name }} <small>[{{ $order->recurrent? 'Recorrente' : 'Unico' }}]</small></h4>
        </div>
        <div class="col-6 text-right">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <div class="btn-group" role="group" aria-label="">
                    <a href="#" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="orders-row">
        <div class="col-12">

        </div>
    </div>
</x-template-layout>


