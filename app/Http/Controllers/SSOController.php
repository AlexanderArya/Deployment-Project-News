<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SSOController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);

            $token = $user->createToken('SocialLoginToken')->accessToken;

            return response()->json([
                'message' => 'Berhasil login via ' . ucfirst($provider),
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal login: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();

            return response()->json([
                'message' => 'Logout berhasil'
            ]);
        }

        return response()->json([
            'message' => 'Token tidak valid atau user tidak ditemukan'
        ], 401);
    }
}
