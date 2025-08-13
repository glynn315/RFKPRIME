<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user_username' => 'required|string',
            'user_password' => 'required|string',
        ]);

        $user = UserAccount::where('user_username', $request->user_username)->first();

        if (!$user || !Hash::check($request->user_password, $user->user_password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
