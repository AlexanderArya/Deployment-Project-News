<?php

use App\Http\Controllers\SSOController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}', [SSOController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SSOController::class, 'handleProviderCallback']);

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('google')->redirect();
// });
