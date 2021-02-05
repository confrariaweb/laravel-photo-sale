@foreach($plans as $plan)
    <div class="col-3">
        <div class="card">
            <img src="{{ asset('storage/images/polaroid.jpg') }}" class="card-img-top" alt="{{ $plan->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $plan->name }}</h5>
                <p class="card-text">
                    {{ $plan->description }}
                </p>
                <p>{{ ($plan->recurrent)? 'Recorrente' : 'Unico' }}</p>
                <a href="#" class="btn btn-primary"><small>R$</small>{{ $plan->price }} <small>mensais</small></a>
                <input type="radio" name="plan" value="{{ $plan->id }}">
            </div>
        </div>
    </div>
@endforeach