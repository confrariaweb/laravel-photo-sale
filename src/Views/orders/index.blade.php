<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>{{ __('photoSale::messages.orders') }}</h4>
        </div>
        <div class="col-8">
            <div class="btn-group float-end" role="group" aria-label="">
                <div class="btn-group" role="group" aria-label="">
                    <a href="#" class="btn btn-outline-secondary">{{ __('photoSale::messages.return') }}</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="orders-row">
        <div class="col-12">
            <table class="table table-striped table-hover datatable" style="width:100%">
                <thead>
                <tr>
                    <th>Plano</th>
                    <th>Status</th>
                    <th>Preço</th>
                    <th>Recorrencia</th>
                    <th>Criado em</th>
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
                            <div class="btn-group btn-group-sm float-end" role="group" aria-label="Basic example">
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                   class="btn btn-sm btn-primary">
                                    <span class="material-icons">{{ __('show') }}</span>
                                </a>
                                @if(auth()->user()->isAdmin() && !$order->isDone())
                                <a href="{{ route('orders.edit', ['order' => $order->id]) }}"
                                   class="btn btn-sm btn-success">
                                    <span class="material-icons">{{ __('edit') }}</span>
                                </a>
                                @endif
                                @if(auth()->user()->isAdmin() && !$order->isDone())
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <span class="material-icons">{{ __('files') }}</span>
                                    </a>
                                @endif
                                @if(!$order->isDone())
                                    <button type="button"
                                            onclick="event.preventDefault(); document.getElementById('formCancelOrder-{{ $order->id }}').submit();"
                                            class="btn btn-sm btn-danger">
                                        <span class="material-icons">{{ __('cancel') }}</span>
                                    </button>
                                    <form id="formCancelOrder-{{ $order->id }}" method="POST"
                                          action="{{ route('orders.cancel', ['order' => $order->id]) }}">
                                        @csrf
                                    </form>
                                @endif
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
                    <th>Criado em</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-template-layout>


