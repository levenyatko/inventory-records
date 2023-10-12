<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends BaseAuthController
{
    protected function guard()
    {
        return Auth::guard('employer');
    }

}
