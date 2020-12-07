<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class RouteRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }
    public function model() {
        return 'App\Route';
    }

    public function getRolesByRoute($route){
        return $this->model->where('route', $route)->pluck('role_id')->toArray();
    }

    public function deleteByRole($role_id){
        $routes = $this->model->where('role_id', $role_id)->get();
        foreach ($routes as $item){
            $item->delete();
        }
    }

}
