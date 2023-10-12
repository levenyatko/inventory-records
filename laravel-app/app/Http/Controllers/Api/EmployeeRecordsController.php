<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsEmployeeManager;
use App\Http\Resources\RecordCollection;
use App\Models\Employee;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeRecordsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:manager', IsEmployeeManager::class]);
    }

    public function __invoke(Employee $employee)
    {
        $records = $employee->records()->paginate();

        return ( new RecordCollection($records) )->response();
    }
}
