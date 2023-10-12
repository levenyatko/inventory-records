<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

class ManagerAuthController extends BaseAuthController
{
    protected function guard()
    {
        return Auth::guard('manager');
    }

}
