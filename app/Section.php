<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $fillable = [
        'parent_id','type','name','background','order_by'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    public function body() {
        return $this->belongsTo('\App\Body', 'parent_id')->where('type','=',2);
    }
    public function menuDetail() {
        return $this->hasMany('\App\MenuDetail', 'menu_id');
    }


}
