<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

    //
    protected $table = 'staff';
    protected $fillable = [
        'full_name', 'dob', 'department_id','position_id', 'phone', 'address', 'permanent_address', 'status', 'code', 'gender', 'is_deleted',
        'insuarance', 'identification', 'identification_date', 'identification_place', 'tax_code', 'km','educational_level',
        'start_date','contract_level_1','contract_level_2','contract_level_3','degree','file'
    ];

    const MALE = 1;
    const FEMALE = 2;

    public function position() {
        return $this->belongsTo('\App\Position');
    }
    public function department() {
        return $this->belongsTo('\App\Department');
    }

    public function getDob() {
        return date('d/m/Y', strtotime($this->dob));
    }

    public function driver() {
        return $this->hasMany('\App\Driver', 'staff_id');
    }

    public function user() {
        return $this->hasOne('\App\User', 'staff_id');
    }

    public function salary(){
        return $this->hasMany('\App\Salary','staff_id');
    }
}
