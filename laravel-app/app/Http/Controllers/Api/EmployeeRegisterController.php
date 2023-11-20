<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Employee\RegisterEmployeeDTO;
use App\Events\EmployeeCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRegisterRequest;
use App\Notifications\WelcomeManagerEmailNotification;
use App\Services\Api\EmployeeService;

class EmployeeRegisterController extends Controller
{
    public function __invoke(EmployeeRegisterRequest $request, EmployeeService $service)
    {
        $employee = $service->registerEmployee( RegisterEmployeeDTO::fromRequest( $request ) );

        $employee->notify( new WelcomeManagerEmailNotification( $employee ) );

        return response()->json([
            'message' => "Employee is created successfully.",
        ])->setStatusCode(201);
    }
}
