<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function redirect(string $provider)
    {
        $driver = Socialite::driver($provider)->stateless();

        return $driver->redirect();
    }

    public function callback(string $provider)
    {
        $social = Socialite::driver($provider)->stateless()->user();

        $user = User::updateOrCreate(
            ['email' => $social->getEmail()],
            [
                'name'        => $social->getName() ?: $social->getNickname(),
                'avatar'      => $social->getAvatar(),
                'provider'    => $provider,
                'provider_id' => $social->getId(),
            ]
        );

        Auth::login($user);

        return redirect()->away(config('app.frontend_url'));
    }

    public function logout(): Response
    {
        if (Auth::check()) {
            Cache::forget('user:' . Auth::id() . ':profile');
            Auth::logout();
        }

        return response()->noContent();
    }
}
