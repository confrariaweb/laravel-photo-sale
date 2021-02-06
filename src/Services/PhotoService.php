<?php

namespace ConfrariaWeb\PhotoSale\Services;

use ConfrariaWeb\PhotoSale\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PhotoService
{

    public function __construct()
    {

    }

    public function all()
    {
        $photos = Auth::user()->photos()->get();
        return $photos;
    }

    public function likeAll()
    {
        $photos = Auth::user()->photos()->where('dislike', false)->get();
        return $photos;
    }

    public function dislikeAll()
    {
        $photos = Auth::user()->photos()->where('dislike', true)->get();
        return $photos;
    }

    public function dislikeUpdate($id)
    {
        $photo = Photo::find($id);
        $dislike = !$photo->dislike;
        $photo->update(['dislike' => $dislike]);
        return $dislike;
    }

    public function socialitePhotosUpdate($driver)
    {
        $photos = $this->socialitePhotos($driver);
        $upsert = Photo::upsert(
            $photos->toArray(),
            ['socialite_id', 'idphoto'],
            ['source', 'name']
        );
        return $upsert;
    }

    public function socialitePhotos($driver)
    {
        if ($driver == 'facebook') {
            return $this->facebookPhotos();
        }
    }

    public function facebookPhotos()
    {
        $data = [];
        $user = Auth::user();
        $socialite = $user->socialites()->where('driver', 'facebook')->first();
        if (!$socialite) {
            return collect($data);
        }
        $token = $socialite->token;
        $url = 'https://graph.facebook.com/me/photos?type=uploaded&fields=link,name,images&limit=200';
        $clientGet = Http::withHeaders([
            "Authorization" => "Bearer {$token}"
        ])->get($url);
        $photos = $clientGet->object()->data;
        foreach ($photos as $p) {
            $data[] = [
                'socialite_id' => $socialite->id,
                'user_id' => $user->id,
                'source' => $p->images[0]->source,
                'name' => $this->namePhoto($p->images[0]->source),
                'idphoto' => $p->id
            ];
        }
        return collect($data);
    }

    public function namePhoto($photo)
    {
        $nameStrStr = strstr($photo, '?', true);
        $nameExplode = explode('/', $nameStrStr);
        $namePhoto = end($nameExplode);
        return $namePhoto;
    }

}
