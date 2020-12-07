<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;

class CategoryController extends Controller {

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }
   
    public function all() {
        $category = $this->categoryRepo->getOption();
        $category_options = \App\Helpers\StringHelper::getCategoryOptions($category);
        return response()->json(['error' => false, 'category_options' => $category_options]);
    }

}
