<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'product_id', 'quantity','into_money','order_id','category_id','status','created_by','price','size_id','color'
    ];

    public function product() {
        return $this->belongsTo('\App\Product', 'product_id');
    }
    public function order() {
        return $this->belongsTo('\App\Order', 'order_id');
    }
}
