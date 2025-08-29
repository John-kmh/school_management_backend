<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CreateUserRequest;
use App\Actions\Auth\CreateUserAction;
use App\Http\Resources\Auth\UserResource;

class UserController extends Controller
{
    public function store(CreateUserRequest $request, CreateUserAction $action)
    {
        $user = $action->execute($request->validated());
        return new UserResource($user);
    }
}
