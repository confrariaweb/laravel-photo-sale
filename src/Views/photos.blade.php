<x-template-layout>
    <div class="row">
        <div class="col-4">
            <h4>Minhas fotos</h4>
        </div>
        <div class="col-8 text-right">
            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <x-buttons-socialite/>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="photos-row">
        @forelse($photos as $photo)
            <div class="col-2 p-2">
                <img
                    data-link="{{ route('photo.preferred.ajax') }}"
                    data-preferred="{{ $photo->preferred }}"
                    data-id="{{ $photo->id }}"
                    data-id_photo="{{ $photo->id_photo }}"
                    data-text=""
                    src="{{ $photo->url }}"
                    class="photo photo-preferred {{ $photo->preferred? 'checked' : 'unchecked' }} img-thumbnail">
            </div>
        @empty
            <div class="col-12">
                <h4 class="text-center text-black-50">{{ __('No photos') }}</h4>
            </div>
        @endforelse
    </div>

    <!-- Modal -->
    <div class="modal fade" id="photosModal" tabindex="-1" aria-labelledby="photosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photosModalLabel">{{ __('photos') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="photosModalForm">
                        @csrf
                        <input type="hidden" name="socialite_id" value="">
                        <div class="row">Carregando...</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-link="{{ route('photo.save.ajax') }}" id="photosModalButton">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-template-layout>


