<?php
	/**
	 *
	 * @class UpdateRecordDTO
	 * @package App\DTOs\Record
	 */

	namespace App\DTOs\Record;

	use App\Http\Requests\RecordUpdateRequest;

    class UpdateRecordDTO{
        public function __construct(
            public readonly int $category_id,
            public readonly string $name
        ) {
        }

        public static function fromRequest(RecordUpdateRequest $request): UpdateRecordDTO
        {
            $validated = $request->validated();

            return new self(
                $validated["category"],
                $validated["name"]
            );
        }

        public function getFilled(): array
        {
            return array_filter($this->toArray());
        }

        public function toArray(): array
        {
            return [
                'category_id' => $this->category_id,
                'name'        => $this->name,
            ];
        }
	}
