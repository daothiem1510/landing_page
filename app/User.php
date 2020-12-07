<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable {

    use Notifiable;

    protected $table = 'user';

    const ROLE_SUPERADMIN = 1;
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_BUSINESS = 12;
    const ROLE_ADMIN = [1, 2, 3, 4, 5, 6, 16];

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'username', 'staff_id','physical_address'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }
    public function staff() {
        return $this->belongsTo('App\Staff');
    }

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    public function isOnline(){
        return Cache::has('user_is_online_'.$this->id);
    }
}
