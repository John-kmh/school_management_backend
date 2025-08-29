<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;

class LogoutUserAction
{
    public function execute(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return true;
    }
}
