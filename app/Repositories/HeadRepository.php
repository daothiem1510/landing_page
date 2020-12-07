<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class HeadRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Head';
    }

    public function getData() {
        return $this->model->where('status', \App\Customer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
    }

    public function validate() {
        return $rules = [
            'alias' => 'required|unique:product',
            'name' => 'required',
        ];
    }
    public function validateUpdate($id)
    {
        return $rules = [
            'name' => 'required',
            'alias' => 'required|unique:product,alias,' . $id . ',id',
        ];
    }


}
