<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'block';
    protected $fillable = [
        'body_id','values','type','title','description','order_by'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }

    public function body() {
        return $this->belongsTo('\App\Page', 'body_id');
    }
    public function blockDetail() {
        return $this->hasMany('\App\BlockDetail', 'block_id');
    }


}
