<?php

    use App\Http\Controllers\Api\EmployeeAuthController;
    use App\Http\Controllers\Api\ManagerAuthController;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::group([
        'prefix'     => 'manager',
    ], function ($router) {

        Route::post('register', App\Http\Controllers\Api\ManagerRegisterController::class)->name('manager.register');

        Route::group([
            'controller' => ManagerAuthController::class
        ], function ($router) {
            Route::post('login', 'login')->name('manager.login');
            Route::post('logout', 'logout')->name('manager.logout');
            Route::post('refresh', 'refresh')->name('manager.refresh');
        });

    });

    Route::group([
        'prefix'     => 'employee',
    ], function() {

        Route::post('register', \App\Http\Controllers\Api\EmployeeRegisterController::class)->name('employee.register');
        Route::get('/{employee}/records', \App\Http\Controllers\Api\EmployeeRecordsController::class)->name('employee.records.index');

        Route::group([
            'controller' => EmployeeAuthController::class
        ], function ($router) {
            Route::post('login', 'login')->name('manager.login');
            Route::post('logout', 'logout')->name('manager.logout');
            Route::post('refresh', 'refresh')->name('manager.refresh');
        });

    });

    Route::group([
        'prefix'     => 'categories',
        'controller' => \App\Http\Controllers\Api\CategoryController::class
    ], function ($router) {

        Route::get('/', 'index')->name('categories.index');
        Route::get('/{category}', 'show')->name('categories.show');
        Route::get('/{category}/records', 'records')->name('categories.records.index');
    });

    Route::apiResource('records', \App\Http\Controllers\Api\RecordController::class);

    Route::fallback(function (){
        abort(404, 'API resource not found');
    });
