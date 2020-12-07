<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Head extends Model
{
    protected $table = 'head';
    protected $fillable = [
        'page_id', 'content','image','title'
    ];

    public function page() {
        return $this->belongsTo('\App\Page', 'page_id');
    }

}
