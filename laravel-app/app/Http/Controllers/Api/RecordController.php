<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureAllowedToRecord;
use App\Http\Middleware\IsAuthorOrManager;
use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;
use App\Http\Resources\RecordCollection;
use App\Http\Resources\RecordResource;
use App\Models\Record;
use App\Notifications\CreatedRecordEmployeeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employer'])->only(['store', 'update', 'show']);
        $this->middleware(['auth:employer,manager'])->only(['index', 'destroy']);
        $this->middleware([ IsAuthorOrManager::class ])->only(['update', 'show', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Auth::user()->records()->paginate();

        return ( new RecordCollection($records) )->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordStoreRequest $request)
    {
        $record = Record::create([
            'employee_id' => Auth::user()->id,
            'category_id' => $request->category,
            'name'        => $request->name,
        ]);

        if ( $request->image ) {
            $img_name = $this->downloadImage($request, $record);

            $record->update([
                'image' => $img_name
            ]);
        }

        Auth::user()->notify( new CreatedRecordEmployeeNotification() );

        return response()->json([
            'message' => "Record is created successfully.",
            'id'      => $record->id
        ])->setStatusCode(201);
    }

    private function downloadImage($request, $record)
    {
        $images_dir_path = storage_path( 'app/public/images/' );

        if ( ! File::isDirectory($images_dir_path) ) {
            File::makeDirectory($images_dir_path, 0777, true, true);
        }

        $img_name = sprintf('images/record-%s.%s', $record->id, $request->image->getClientOriginalExtension());

        $request->file('image')->storeAs('public', $img_name);

        return $img_name;
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
    public function update(RecordUpdateRequest $request, Record $record)
    {
        $new_data = [];

        if ($request->category) {
            $new_data['category_id'] = $request->category;
        }

        if ($request->name) {
            $new_data['name'] = $request->name;
        }

        if ( $request->image ) {
            $new_data['image'] = $this->downloadImage($request, $record);
        }

        $record->update($new_data);

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
