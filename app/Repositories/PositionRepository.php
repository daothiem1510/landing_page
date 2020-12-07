<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class PositionRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Position';
    }

    public function validate() {
        return $rules = [
            'name' => 'required',
        ];
    }

    public function getPositionId($name) {
        $position = $this->model->where('name', $name)->first();
        if ($position) {
            return $position->id;
        } else {
            $item = $this->model->create(['name' => $name, 'status' => 1]);
            return $item->id;
        }
    }

}
