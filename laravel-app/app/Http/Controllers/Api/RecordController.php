<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Record\StoreRecordDTO;
use App\DTOs\Record\UpdateRecordDTO;
use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAllowedToRecord;
use App\Http\Middleware\IsAuthorOrManager;
use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;
use App\Http\Resources\RecordCollection;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use App\Notifications\CreatedRecordEmployeeNotification;
use App\Services\Api\RecordService;
use App\Services\Api\UploadService;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employer'])->only(['store', 'update', 'show']);
        $this->middleware(['auth:employer,manager'])->only(['index', 'destroy']);
        $this->middleware([IsAuthorOrManager::class])->only(['update', 'show', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RecordService $service)
    {
        $records = $service->getCurrentUserRecords();

        return ( new RecordCollection($records) )->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordStoreRequest $request, RecordService $record_service, UploadService $upload_service)
    {
        $record = $record_service->storeRecord(StoreRecordDTO::fromRequest($request));

        if ( $request->image ) {
            $uploaded_image = $upload_service->upload($request->file('image'), $record);
            $record_service->updateRecordImage($record, $uploaded_image);
        }

        Auth::user()->notify( new CreatedRecordEmployeeNotification() );

        return response()->json([
            'message' => "Record is created successfully.",
            'id'      => $record->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        return (new RecordResource($record))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecordUpdateRequest $request, Record $record, RecordService $record_service, UploadService $upload_service)
    {
        $uploaded_image = null;
        if ( $request->image ) {
            $uploaded_image = $upload_service->upload($request->file('image'), $record);
        }

        $new_record_data = UpdateRecordDTO::fromRequest($request);
        $record_service->updateRecord($record, $new_record_data, $uploaded_image);

        return response()->json([
            'message' => "Record updated.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return response()->json([
            'message' => "Record deleted.",
        ]);
    }
}
