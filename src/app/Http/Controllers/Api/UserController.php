<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Api\Auth\RegisteredUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class UserController
{
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
