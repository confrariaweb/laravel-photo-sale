<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Print Moments</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('dashboard') }}">{{ __('Minhas fotos') }}</a>
        <a class="p-2 text-dark" href="{{ route('users.profile') }}">{{ __('Meus dados') }}</a>
        <a class="p-2 text-dark" href="{{ route('users.payment.information') }}">{{ __('Informações de pagamentos') }}</a>
        <a class="p-2 text-dark" href="{{ route('checkout.index') }}">{{ __('Checkout') }}</a>
        <a class="p-2 text-dark" href="{{ route('orders.index') }}">{{ __('Pedidos') }}</a>
    </nav>
    <button class="btn btn-sm btn-outline-primary"
            onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        {{ __('Sair') }}
    </button>
    <form id="formLogout" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
</div>
