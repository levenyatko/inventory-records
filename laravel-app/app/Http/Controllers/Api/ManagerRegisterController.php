<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Manager\RegisterManagerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Api\ManagerService;

class ManagerRegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, ManagerService $service)
    {
        $service->registerManager( RegisterManagerDTO::fromRequest( $request ) );

        return response()->json([
            'message' => "You are registered. Please, login.",
        ])->setStatusCode(201);
    }

}
