<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $table = 'role';

    const ROLE_ADMINISTRATOR = 1;
    const ROLE_STAFF = 12;
    const ROLE_MANAGER = 4;
    const ROLE_ACCOUNTANT = 18;
    const ROLE_CCM = 5;
    const ROLE_CEO = 22;

    protected $fillable = [
        'name', 'route'
    ];

    public function routes() {
        return $this->hasMany('App\Route');
    }

    public function route() {
        return explode(',', $this->route);
    }

}
