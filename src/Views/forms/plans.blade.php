<div class="card-deck mb-3 text-center">
    @foreach($plans as $plan)
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">
                    <small class="text-muted">R$</small>
                    {{ $plan->price }}
                    <small class="text-muted">/ mes</small>
                </h1>
                {{ $plan->description }}
                <p>{{ ($plan->recurrent)? 'Recorrente' : 'Unico' }}</p>
                <button type="button" class="btn btn-lg btn-block btn-outline-primary">
                    Escolher
                    <input type="radio" name="plan" value="{{ $plan->id }}">
                </button>

            </div>
        </div>
    @endforeach
</div>