<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        if (! $token = auth()->attempt(
            [
                'name' => env('APP_LOGIN'),
                'password' => env('APP_PASSWORD')
            ]
        )) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    private function respondWithToken($token)
    {
        return "Bearer $token";
    }
}
