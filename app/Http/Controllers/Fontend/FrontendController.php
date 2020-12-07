<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;
use Repositories\ConstructionRepository;
use Repositories\KeywordRepository;
use Repositories\ProductRepository;

class FrontendController extends Controller {

    public function __construct(CategoryRepository $categoryRepo,ProductRepository $productRepo) {
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
    }

    public function index($alias) {
        $product = $this->productRepo->all()->where('alias',$alias)->first();
        $page = $product->page;
        $menu = $page->menu;
        $head = $page->head;
        $files = explode(',',$head->image);
        return view('frontend/home/template_1',compact('product','page','menu','head','files'));
    }

}

