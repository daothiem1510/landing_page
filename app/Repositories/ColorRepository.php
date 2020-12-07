<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;

class ColorRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Color';
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
