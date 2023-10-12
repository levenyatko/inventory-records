<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerRegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make( $request->password ),
        ]);

        return response()->json([
            'message' => "You are registered. Please, login.",
        ])->setStatusCode(201);
    }

}
