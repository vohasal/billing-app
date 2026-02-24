<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\UserDTO;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::query()->create($request->validated());

        $userDto = UserDTO::from($user->toArray());
        event(new UserRegistered($userDto));
        return $user;
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'message' => 'Wrong email or password'
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'user' => $user,
            'token' => $user->createToken("Token of user: {$user->name}")->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'token removed'
        ]);
    }
}
