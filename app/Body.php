<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
{
    protected $table = 'Body';
    protected $fillable = [
        'page_id','name'
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
}
