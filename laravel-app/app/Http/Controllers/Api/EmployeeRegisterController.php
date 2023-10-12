<?php

namespace App\Http\Controllers\Api;

use App\Events\EmployeeCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRegisterRequest;
use App\Models\Employee;
use App\Notifications\WelcomeManagerEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeRegisterController extends Controller
{
    public function __invoke(EmployeeRegisterRequest $request)
    {
        $employee = Employee::create([
            'email'      => $request->email,
            'password'   => Hash::make( $request->password ),
            'user_id'    => Auth::user()->id
        ]);

        $employee->notify( new WelcomeManagerEmailNotification( $employee ) );

        return response()->json([
            'message' => "Employee is created successfully.",
        ])->setStatusCode(201);
    }
}
