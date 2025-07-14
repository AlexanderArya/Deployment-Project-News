<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->Validated(['name' => 'required', 'email' => 'required', 'password' => 'required']);
        $user = User::create($validated);
        return $user;
    }
}
