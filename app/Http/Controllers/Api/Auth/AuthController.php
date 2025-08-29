<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\UpdateProfileAction;
use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Auth\AuthTokenResource;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;

class AuthController extends Controller
{
     public function login(LoginRequest $request, LoginUserAction $action)
    {
        $data = $action->execute($request);

        return new AuthTokenResource($data);
    }

    public function logout(LogoutUserAction $action)
    {
        $action->execute(request());
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function profile()
    {
        return new UserResource(auth()->user());
    }

    public function updateProfile(UpdateProfileRequest $request, UpdateProfileAction $action)
    {
        $user = $action->execute($request);
        return new UserResource($user);
    }

    public function resetPassword(ResetPasswordRequest $request, ResetPasswordAction $action)
    {
        $action->execute($request);
        return response()->json(['message' => 'Password updated successfully']);
    }
}
