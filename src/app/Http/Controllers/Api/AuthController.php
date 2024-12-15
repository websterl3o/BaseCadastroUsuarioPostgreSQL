<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\Api\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class AuthController
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => "Bearer $token",
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ], Response::HTTP_OK);
    }
}
