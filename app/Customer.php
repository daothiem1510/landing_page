<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = [
        'name','sex','address','phone','email'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }
    public function products() {
        return $this->belongsToMany('\App\Product', 'product_category', 'category_id', 'product_id');
    }

    public function parents() {
        return $this->belongsTo('\App\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('\App\Category', 'parent_id');
    }
}
