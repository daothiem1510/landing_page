<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    protected $table = 'menu_detail';
    protected $fillable = [
        'menu_id','name','link'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    public function menu() {
        return $this->belongsTo('\App\Page', 'menu_id');
    }


}
