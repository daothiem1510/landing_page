<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;
use App\Notifications\Notificate;
use Pusher\Pusher;

class UserRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\User';
    }

    public function validateCreate() {
        return $rules = [
            'username' => 'required|unique:user',
        ];
    }

    public function validateUpdate($id) {
        return $rules = [
            'username' => 'required|unique:user,username,' . $id . ',id',
            'role_id' => 'required',
            'name' => 'required'
        ];
    }

    function getAllUser() {
        $users = $this->model->where('role_id', '<>', \App\User::ROLE_SUPERADMIN)->get();
        return $users;
    }

    public function getUserByRole($role_ids){
        return $this->model->whereIn('role_id', $role_ids)->where('staff_id','<>',0)->get();
    }

}
