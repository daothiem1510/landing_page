<?php

namespace Repositories;

use App\Position;
use Illuminate\Support\Facades\DB;
use Repositories\Support\AbstractRepository;

class StaffRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Staff';
    }

    public function validate() {
        return $rules = [
            'full_name' => 'required',
            'code' => 'required',

        ];
    }
    public function getStaff($code)
    {
        $staff = $this->model->where('code', $code)->first();
        return $staff->id;
    }
    public function getAll(){
        return  $this->model->where('is_deleted',0)->get();
    }
    public function getDriver(){
        return $this->model->whereIn('position_id', \App\Position::DRIVER)->get();
    }
    public function getStaffByVehicle($vehicle_id){
        $vehicle = DB::table('driver')->where('vehicle_id',$vehicle_id)->where('is_deleted',0)->first();
        return $this->model->find($vehicle->staff_id)->full_name;
    }
    public function getInfoStaffByVehicle($vehicle_id){
        $vehicle = DB::table('driver')->where('vehicle_id',$vehicle_id)->where('is_deleted',0)->first();
        return $this->model->find($vehicle->staff_id);
    }

}
