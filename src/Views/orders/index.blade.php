<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>Lista de pedidos</h4>
        </div>
        <div class="col-8 text-right">
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
            <table class="table table-striped datatable" style="width:100%">
                <thead>
                <tr>
                    <th>Plano</th>
                    <th>Status</th>
                    <th>Preço</th>
                    <th>Recorrencia</th>
                    <th>Data</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->plan->name }}</td>
                        <td>{{ $order->status->name }}</td>

                        <td><small>R$</small>{{ number_format($order->price, 2, ',', '.') }}</td>
                        <td>{{ $order->recurrent? 'Recorrente' : 'Unico' }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-secondary">
                                    <span class="material-icons">pageview</span>
                                </a>
                                <a href="{{ route('orders.edit', ['order' => $order->id]) }}" class="btn btn-sm btn-success">
                                    <span class="material-icons">edit</span>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <span class="material-icons">cancel</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Plano</th>
                    <th>Status</th>

                    <th>Preço</th>
                    <th>Recorrencia</th>
                    <th>Data</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-template-layout>


