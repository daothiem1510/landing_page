<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class RoleRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Role';
    }
    function getAllRole() {
        $roles = $this->model->where('id', '<>', 1)->get();
        return $roles;
    }
    public function validateCreate(){
        return $rules=[
            'name'=> 'required|unique:role'
        ];
    }
    public function validateUpdate(){
        return $rule=['name'=>'requires'];
    }
    
    

}
