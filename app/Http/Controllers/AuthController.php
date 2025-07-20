<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect user ke halaman login Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google setelah user login
     */
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if (!$user) {
                // User baru
                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar'    => $googleUser->getAvatar(),
                ]);
            } else {
                // User sudah ada, perbarui jika perlu
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                }
                $user->avatar = $googleUser->getAvatar();
                $user->save();
            }

            // Login dan regenerate session
            Auth::login($user);
            $request->session()->regenerate();

            // Redirect ke frontend (SPA)
            return redirect('http://localhost:5173?login=success');

        } catch (\Exception $e) {
            // Jika gagal, redirect dengan error (bisa sesuaikan)
            return redirect('http://localhost:5173?login=error');
        }
    }

    /**
     * Logout user dari session
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Logout successfully',
        ]);
    }

    /**
     * Mendapatkan data user yang sedang login
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
