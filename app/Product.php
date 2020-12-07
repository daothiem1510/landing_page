<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name', 'alias','content','description','image','category_id','status','created_by','price','size_ids','color_id','video',
    ];

    public function createdBy() {
        return $this->belongsTo('\App\User', 'created_by');
    }
    public function category() {
        return $this->belongsTo('\App\Category', 'category_id');
    }
    public function size() {
        return $this->belongsTo('\App\Size', 'size_id');
    }
    public function color() {
        return $this->belongsTo('\App\Color', 'color_id');
    }
    public function templateContribute() {
        return $this->hasMany('\App\TemplateContribute','product_id');
    }
    public function page() {
        return $this->hasOne('\App\Page','product_id');
    }
}
