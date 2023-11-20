<?php
	/**
	 *
	 * @class RegisterEmployeeDTO
	 * @package App\DTOs\Employee
	 */

	namespace App\DTOs\Employee;

	use App\Http\Requests\EmployeeRegisterRequest;
    use Illuminate\Support\Facades\Auth;

    class RegisterEmployeeDTO {

        public function __construct(
            public readonly int $user_id,
            public readonly string $email,
            public readonly string $password
        ) {
        }

        public static function fromRequest(EmployeeRegisterRequest $request): RegisterEmployeeDTO
        {
            $user_id   = Auth::user()->id;
            $validated = $request->validated();

            return new self(
                $user_id,
                $validated["email"],
                $validated["password"]
            );
        }

        public function toArray(): array
        {
            return [
                'user_id'     => $this->user_id,
                'email'       => $this->email,
                'password'    => $this->password,
            ];
        }
	}
