<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'page_id'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    public function page() {
        return $this->belongsTo('\App\Page', 'page_id');
    }
    public function menuDetail() {
        return $this->hasMany('\App\MenuDetail', 'menu_id');
    }


}
