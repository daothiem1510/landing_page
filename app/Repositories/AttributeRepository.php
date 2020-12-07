<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class AttributeRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Attribute';
    }

    public function getData() {
        return $this->model->where('status', \App\Customer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
    }

    public function getAll() {
        return $this->model->where('staff_id', 0)->get();
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
