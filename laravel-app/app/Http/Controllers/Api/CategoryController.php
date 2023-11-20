<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RecordCollection;
use App\Models\Category;
use App\Services\Api\CategoryService;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employer,manager']);
    }

    public function index( CategoryService $service )
    {
        $categories = $service->getCategoriesList();

        return ( new CategoryCollection($categories) )->response();
    }

    public function show(Category $category)
    {
        return (new CategoryResource($category))->response();
    }

    public function records(Category $category, CategoryService $service)
    {
        $records = $service->getCategoryRecords($category);

        return ( new RecordCollection($records) )->response();
    }

}
