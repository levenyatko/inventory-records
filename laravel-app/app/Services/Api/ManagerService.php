<?php
	/**
	 *
	 * @class ManagerService
	 * @package App\Services\Api
	 */

	namespace App\Services\Api;

    use App\DTOs\Manager\RegisterManagerDTO;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class ManagerService{

        public function registerManager( RegisterManagerDTO $data ) {

            User::create([
                'name'     => $data->name,
                'email'    => $data->email,
                'password' => Hash::make( $data->password ),
            ]);

        }

	}
