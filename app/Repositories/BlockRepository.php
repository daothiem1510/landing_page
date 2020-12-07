<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class BlockRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Block';
    }

    public function getAll() {
        return $this->model->orderBy('order_by','ASC')->get();
    }

    public function validate() {
        return $rules = [
            'alias' => 'required',
            'name' => 'required|unique:page',
        ];
    }
    public function validateUpdate($id)
    {
        return $rules = [
            'name' => 'required|unique:page,name,' . $id . ',id',
            'alias' => 'required',
        ];
    }


}
