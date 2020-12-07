<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockDetail extends Model
{
    protected $table = 'block_detail';
    protected $fillable = [
        'block_id','image','title','description'
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
