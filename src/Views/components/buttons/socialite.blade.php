@foreach($buttons as $button)
    <button type="button"
            data-link="{{ $button['url'] }}"
            data-socialite_id="{{ $button['id'] }}"
            id="{{ $button['id'] }}"
            class="btn btn-primary buttonPhotos"
            data-toggle="{{ $button['data-toggle'] }}"
            data-target="{{ $button['data-target'] }}">
        {{ $button['title'] }}
    </button>
@endforeach
