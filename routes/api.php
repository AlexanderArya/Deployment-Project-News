<?php

<<<<<<< HEAD
use App\Http\Controllers\SSOController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('web')->group(function () {
    Route::get('/auth/{provider}', [SSOController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [SSOController::class, 'handleProviderCallback']);
});
//middleware web digunakan untuk mengaktifkan session dan CSRF protection

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [SSOController::class, 'logout']);
});
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
>>>>>>> 71a1939401dd6969ca48fa3a7d2dd09fc54ef432
