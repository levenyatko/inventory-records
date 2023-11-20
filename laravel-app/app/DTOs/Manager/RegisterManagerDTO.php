<?php
	/**
	 *
	 * @class RegisterManagerDTO
	 * @package App\DTOs\Manager
	 */

	namespace App\DTOs\Manager;

	use App\DTOs\Employee\Auth;
    use App\Http\Requests\RegisterRequest;

    class RegisterManagerDTO {

        public function __construct(
            public readonly string $name,
            public readonly string $email,
            public readonly string $password
        ) {
        }

        public static function fromRequest(RegisterRequest $request): RegisterManagerDTO
        {
            $validated = $request->validated();

            return new self(
                $validated["name"],
                $validated["email"],
                $validated["password"]
            );
        }

        public function toArray(): array
        {
            return [
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => $this->password,
            ];
        }
	}
