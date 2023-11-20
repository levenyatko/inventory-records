<?php
	/**
	 *
	 * @class UploadedImageDTO
	 * @package App\DTOs\File
	 */

	namespace App\DTOs\File;

	class UploadedImageDTO{
        public function __construct(
            public readonly string $name,
            public readonly string $mime,
            public readonly string $path
        ) {}

        public function toArray(): array
        {
            return [
                'name'       => $this->name,
                'mime_type'  => $this->mime,
                'path'       => $this->path,
            ];
        }
	}
