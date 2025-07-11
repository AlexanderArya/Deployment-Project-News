<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('profile', fn() => auth()->user());
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('auth')->middleware('web')->group(function () {
    Route::get('{provider}/redirect',  [AuthController::class, 'redirect'])
        ->where('provider', 'google|facebook');
    Route::get('{provider}/callback',  [AuthController::class, 'callback'])
        ->where('provider', 'google|facebook');
});
