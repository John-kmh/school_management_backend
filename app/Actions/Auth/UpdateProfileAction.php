<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class UpdateProfileAction
{
    public function execute(UpdateProfileRequest $request)
    {
        $user = $request->user();

        if ($request->filled('fullname')) $user->fullname = $request->fullname;
        if ($request->filled('username')) $user->username = $request->username;
        if ($request->filled('email')) $user->email = $request->email;
        if ($request->filled('password')) $user->password = Hash::make($request->password);

        $user->save();

        // Handle avatar upload using Media Library
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars'); // remove old
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        return $user;
    }
}
