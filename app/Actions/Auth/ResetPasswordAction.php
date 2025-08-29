<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    public function execute(ResetPasswordRequest $request)
    {
        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            abort(403, 'Current password does not match');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return true;
    }
}
