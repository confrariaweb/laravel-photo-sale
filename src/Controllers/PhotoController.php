<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use ConfrariaWeb\PhotoSale\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    public function index()
    {
        $data['photos'] = resolve('PhotoService')->likeAll();
        $data['title'] = 'Minhas fotos';
        return view('photoSale::photos.index', $data);
    }

    public function dislikeIndex()
    {
        $data['photos'] = resolve('PhotoService')->dislikeAll();
        $data['title'] = 'Não quero';
        return view('photoSale::photos.index', $data);
    }

    public function dislikeUpdate($id)
    {
        return resolve('PhotoService')->dislikeUpdate($id);
    }

    public function socialitePhotosUpdate($driver)
    {
        $p = resolve('PhotoService')->socialitePhotosUpdate($driver);
        return back()->withInput()
            ->with('status', 'Fotos atualizadas com sucesso');
    }


    public function photoDriverJson($driver)
    {
        $socialite = Auth::user()->socialites()->where('driver', $driver)->first();
        $token = $socialite->token;
        $url = 'https://graph.facebook.com/me/photos?type=uploaded&fields=link,name,images&limit=200';
        $clientGet = Http::withHeaders([
            "Authorization" => "Bearer {$token}"
        ])->get($url);

        return $clientGet->json();
    }

    public function photoSaveAjax(Request $request)
    {
        $user = Auth::user();
        foreach ($request->photos as $photo) {
            $nameStrStr = strstr($photo['src'], '?', true);
            $nameExplode = explode('/', $nameStrStr);
            $namePhoto = end($nameExplode);
            Photo::updateOrCreate(
                [
                    'id_photo' => $photo['id_photo']
                ],
                [
                    'socialite_id' => $request->socialite_id,
                    'url' => $photo['src'],
                    'name' => $namePhoto,
                    'user_id' => $user->id
                ]
            );
        }
        $photos = $user->photos()->get();
        return response()->json([
            'photos' => $photos,
            'error' => false,
            'message' => 'Fotos enviadas com sucesso',
        ]);

    }

    public function photoSave(Request $request)
    {
        $photos = [];
        $user = Auth::user();
        foreach ($request->photos as $id => $photo) {
            $nameStrStr = strstr($photo, '?', true);
            $nameExplode = explode('/', $nameStrStr);
            $namePhoto = end($nameExplode);
            Photo::updateOrCreate(
                [
                    'id_photo' => $id
                ],
                [
                    'socialite_id' => $request->socialite_id,
                    'url' => $photo,
                    'name' => $namePhoto,
                    'user_id' => $user->id
                ]
            );
        }


        //Photo::upsert($photos, ['id_photo'], ['socialite_id', 'url', 'name']);
        //$user->photos()->createMany($photos);

        return back()->withInput();
    }

    public function photoUpload(Request $request)
    {
        $url = 'https://cdn.jpegmini.com/user/images/slider_puffin_before_mobile.jpg';
        //$request->photos;
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        //dd($name);
        $path = Storage::disk('public')->putFile($name, $contents);
        dd($path);
    }

    public function photoPreferred(Request $request)
    {
        $photo = Photo::find($request->id);
        $photo->preferred = $request->preferred;
        $photo->save();
    }

}
