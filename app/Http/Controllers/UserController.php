<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function me()
    {
        return $this->success(data: auth()->user());
    }
}
