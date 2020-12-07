<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'customer_id', 'product_id','code','payment_method','total','contract','email','phone','note'
    ];

    public function customer() {
        return $this->belongsTo('\App\Customer', 'customer_id');
    }
    public function product() {
        return $this->belongsTo('\App\Product', 'product_id');
    }
}
