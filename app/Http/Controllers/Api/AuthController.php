<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if(!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        /** @var User $user */
        $user = auth()->user();
        $user->loadCount('inventories');
        $user->access_token =$user->createToken('auth_token')->plainTextToken;

        return new UserResource(auth()->user());

    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $user->access_token = $user->createToken('auth_token')->plainTextToken;

        return new UserResource($user);
    }
}
