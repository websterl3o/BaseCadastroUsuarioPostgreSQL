<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Api\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Auth\RegisteredUserRequest;
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
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], Response::HTTP_OK);
    }

    public function register(RegisteredUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'User registered.',
            'user' => $user
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => [
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ]
        ]);
    }
}
