<?php
	/**
	 *
	 * @class UploadService
	 * @package App\Services\Api
	 */

	namespace App\Services\Api;

	use App\DTOs\File\UploadedImageDTO;
    use App\Models\Record;
    use Illuminate\Support\Facades\File;

    class UploadService{

        public function upload(UploadedFile $image, Record $record): UploadedImageDTO
        {
            $images_dir_path = storage_path( 'app/public/images/' );

            if ( ! File::isDirectory($images_dir_path) ) {
                File::makeDirectory($images_dir_path, 0777, true, true);
            }

            $img_name = sprintf('record-%s.%s', $record->id, $image->getClientOriginalExtension());
            $img_path = 'images/' . $img_name;

            $image->storeAs('public', $img_path);

            return new UploadedImageDTO(
                name: $img_path,
                mime: $image->getClientMimeType(),
                path: $img_path,
            );
        }

	}
