<?php
	/**
	 *
	 * @class StoreRecordDTO
	 * @package App\DTOs\Record
	 */

	namespace App\DTOs\Record;

	use App\Http\Requests\RecordStoreRequest;
    use Illuminate\Support\Facades\Auth;

    class StoreRecordDTO{
        public function __construct(
            public readonly int $employee_id,
            public readonly int $category_id,
            public readonly string $name
        ) {
        }

        public static function fromRequest(RecordStoreRequest $request): StoreRecordDTO
        {
            $user_id   = Auth::user()->id;
            $validated = $request->validated();

            return new self(
                $user_id,
                $validated["category"],
                $validated["name"]
            );
        }

        public function toArray(): array
        {
            return [
                'employee_id' => $this->employee_id,
                'category_id' => $this->category_id,
                'name'        => $this->name,
            ];
        }
	}
