<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>{{ $title }} <small class="text-muted">({{ $photos->count() }})</small></h4>
        </div>
        <div class="col-8 text-right">
            <div class="btn-group float-right" role="group" aria-label="Facebook">
                <button type="button"
                        title="Upload"
                        class="btn btn-primary buttonPhotos">
                    <i class="fa fa-upload"></i>
                </button>
                <button type="button"
                        title="Facebook"
                        onclick="event.preventDefault(); document.getElementById('formButtonPhotosFacebook').submit();"
                        class="btn btn-primary buttonPhotos">
                    <i class="fab fa-facebook"></i>
                </button>
                <button type="button"
                        title="Instagram"
                        class="btn btn-primary buttonPhotos">
                    <i class="fab fa-instagram"></i>
                </button>
            </div>
            <div class="btn-group float-right mr-3" role="group" aria-label="Basic example">
                <a href="{{ route('photos.like') }}" class="btn btn-primary">
                    <i class="fa fa-thumbs-up"></i> Quero
                </a>
                <a href="{{ route('photos.dislike') }}" class="btn btn-danger">
                    <i class="fa fa-thumbs-down"></i> Não Quero
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="photos-row">
        @forelse($photos as $photo)
            <div class="col-3 p-3 col-card-photo">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top"
                         data-src="{{ $photo->source }}"
                         alt="Thumbnail"
                         style="width: 100%; display: block;"
                         src="{{ $photo->source }}"
                         data-holder-rendered="true">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button"
                                        title="{{ $photo->dislike? 'Marcar como "eu quero" essa foto' : 'Marcar como "não quero" essa foto' }}"
                                        class="btn btn-sm {{ $photo->dislike? 'btn-outline-primary' : 'btn-outline-danger' }} photosDislike"
                                        data-id="{{ $photo->id }}"
                                        data-link="{{ route('photos.dislike.update', ['photo' => $photo->id]) }}">
                                    <i class="{{ $photo->dislike? 'fa fa-thumbs-up' : 'fa fa-thumbs-down' }}"></i>
                                </button>
                            </div>
                            <i title="{{ Str::title($photo->socialite->driver) }}" class="fab fa-2x fa-{{ $photo->socialite->driver }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h4 class="text-center text-black-50">{{ __('No photos') }}</h4>
            </div>
        @endforelse
    </div>
    <form id="formButtonPhotosFacebook"
          method="POST"
          action="{{ route('photos.socialite.update', ['driver' => 'facebook'])}}">
        @csrf
    </form>
</x-template-layout>


