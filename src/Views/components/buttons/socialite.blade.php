@foreach($buttons as $button_k => $button)
    <a href="{{ $button['url'] }}"
       title="{{ $button['title'] }}"
       onclick="event.preventDefault(); document.getElementById('formButtonPhotos-{{ $button_k }}').submit();"
       class="btn btn-sm btn-primary buttonPhotos">

        <i class="fab fa-{{ $button_k }}"></i>
    </a>

    <form id="formButtonPhotos-{{ $button_k }}" method="POST" action="{{ $button['url'] }}">
        @csrf
    </form>


    <!--button type="button"
            data-link="{{ $button['url'] }}"
            data-socialite_id="{{ $button['id'] }}"
            id="{{ $button['id'] }}"
            class="btn btn-primary buttonPhotos"
            data-toggle="{{ $button['data-toggle'] }}"
            data-target="{{ $button['data-target'] }}">
        {{ $button['title'] }}
            </button-->
@endforeach
