<?php
	/**
	 *
	 * @class CategoryService
	 * @package App\Services\Api
	 */

	namespace App\Services\Api;

	use App\Models\Category;
    use Illuminate\Support\Facades\Auth;

    class CategoryService{

        public function getCategoriesList() {
            return Category::paginate();
        }

        public function getCategoryRecords ( Category $category ) {
            return Auth::user()->records()->where('category_id', $category->id)->paginate();
        }

	}
