<?php
	/**
	 *
	 * @class RecordService
	 * @package App\Services\Api
	 */

	namespace App\Services\Api;

	use App\DTOs\File\UploadedImageDTO;
    use App\DTOs\Record\StoreRecordDTO;
    use App\DTOs\Record\UpdateRecordDTO;
    use App\Models\Record;
    use Illuminate\Support\Facades\Auth;

    class RecordService{

        public function getCurrentUserRecords() {
            return Auth::user()->records()->paginate();
        }

        public function storeRecord(StoreRecordDTO $data) {
            return Record::create($data->toArray());
        }

        public function updateRecord(Record $record, UpdateRecordDTO $new_data, null|UploadedImageDTO $image) {

            $new_data_arr = $new_data->getFilled();

            if ( $image ) {
                $new_data_arr['image'] = $image->path;
            }

            $record->update($new_data_arr);
        }

        public function updateRecordImage(Record $record, UploadedImageDTO $image) {
            $record->update([
                'image' => $image->path
            ]);
        }


	}
