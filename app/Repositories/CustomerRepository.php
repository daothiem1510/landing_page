<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class CustomerRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Customer';
    }

    public function getData() {
        return $this->model->where('status', \App\Customer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->get();
    }

    public function getAll() {
        return $this->model->where('staff_id', 0)->get();
    }
    public function findByName($name) {
        return $this->model->where('name', 'like', '%'.$name.'%')->first();
    }
    public function readBE($request) {
        $query = $this->model;
        if ($request->get('id') != null) {
            return $query->where('id', $request->get('id'))->paginate(10);
        }
        if (\Auth::user()->role_id == \App\Role::ROLE_ADMINISTRATOR) {
            return $query->orderBy('id', 'desc')->paginate(10);
        }
        if (\Auth::user()->role_id == \App\Role::ROLE_STAFF) {
            return $query->orderBy('id', 'desc')->paginate(10);
//            return $query->orderBy('id', 'desc')->where('staff_id', \Auth::user()->id)->paginate(10);
        }
        switch (\Auth::user()->role_id) {
            case \App\Role::ROLE_MANAGER:
                $query = $query->where('status', \App\Customer::STATUS_MANAGER);
                break;
            case \App\Role::ROLE_ACCOUNTANT:
                $query = $query->whereIn('status', [\App\Customer::STATUS_ACCOUNTANT, \App\Customer::STATUS_ACTIVE]);
                break;
            case \App\Role::ROLE_CCM:
                $query = $query->where('status', \App\Customer::STATUS_CCM);
                break;
            case \App\Role::ROLE_CEO:
                $query = $query->where('status', \App\Customer::STATUS_CEO);
                break;
        }
        return $query->orWhere('status', \App\Customer::STATUS_CANCEL)->orderBy('id', 'desc')->paginate(10);
    }


    public function validate() {
        return $rules = [
            'code' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'account_number' => 'required',
            'tax_code' => 'required',
            'fax' => 'required',
            'limit_money' => 'required',
            'checkout_time' => 'required'
        ];
    }


}
