<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class CategoryRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Category';
    }

    public function validate() {
        return $rules = [
            'name' => 'required',
        ];
    }

    public function getAll() {
        return $this->model->where('status', 1)->orderBy('created_at', 'DESC')->get();
    }
    public function readHomeProductCategory() {
        return $this->model->where('type', \App\Category::TYPE_PRODUCT)->where('parent_id', \App\Category::PRODUCT_SHOP_ID)->get();
    }

}
