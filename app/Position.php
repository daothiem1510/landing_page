<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model {

//    const DRIVER = ['21','22'];
    protected $table = 'position';
    protected $fillable = [
        'name', 'status'
    ];

}
