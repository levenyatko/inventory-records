<?php
	/**
	 *
	 * @class EmployeeService
	 * @package App\Services\Api
	 */

	namespace App\Services\Api;

	use App\DTOs\Employee\RegisterEmployeeDTO;
    use App\Models\Employee;
    use Illuminate\Support\Facades\Hash;

    class EmployeeService{

        public function registerEmployee( RegisterEmployeeDTO $data ) {

            return Employee::create([
                'email'      => $data->email,
                'password'   => Hash::make( $data->password ),
                'user_id'    => $data->user_id,
            ]);

        }

	}
