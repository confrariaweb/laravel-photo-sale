<?php

namespace ConfrariaWeb\PhotoSale\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)
            //->fields(['name', 'email'])
            //->scopes(['user_photos'])
            //->asPopup()

            ->fields([
                'first_name', 'last_name', 'email', 'gender', 'birthday', 'location', 'hometown', 'age_range', 'friends', 'posts', 'photos'
            ])->scopes([
                'email', 'user_birthday', 'user_gender', 'user_location', 'user_hometown',
                'user_age_range', 'user_friends', 'user_link', 'user_photos', 'user_posts',
                'user_tagged_places', 'user_videos', 'user_likes',
            ])
            ->redirect();
    }

    public function callback($driver)
    {
        $userSocialite = Socialite::driver($driver)->user();
        $credentials = [
            'name' => $userSocialite->name,
            'email' => $userSocialite->email,
            'avatar' => $userSocialite->avatar,
        ];
        $user = User::firstOrCreate(['email' => $credentials['email']], $credentials);
        $socialite = $user->socialites()->where(['driver' => $driver, 'driver_id' => $userSocialite->id])->first();
        if (!$socialite) {
            $user->socialites()->create(['token' => $userSocialite->token, 'driver' => $driver, 'driver_id' => $userSocialite->id]);
        } else {
            $socialite->update(['token' => $userSocialite->token]);
        }
        Auth::login($user);
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
