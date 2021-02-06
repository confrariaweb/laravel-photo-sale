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
