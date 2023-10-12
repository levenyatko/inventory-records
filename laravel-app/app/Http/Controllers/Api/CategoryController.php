<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RecordCollection;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:employer,manager']);
    }

    public function index()
    {
        $categories = Category::paginate();
        return ( new CategoryCollection($categories) )->response();
    }

    public function show(Category $category)
    {
        return (new CategoryResource($category))->response();
    }

    public function records(Category $category)
    {
        $records = Auth::user()->records()->where('category_id', $category->id)->paginate();

        return ( new RecordCollection($records) )->response();
    }

}
