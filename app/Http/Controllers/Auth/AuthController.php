<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class AuthController
{
    public function register(Request $request)
    {
        $validator = validator($request->all(), [
            "email" => "string"
        ]);

        return;
    }
}
