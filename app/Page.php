<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    protected $fillable = [
        'brand','logo','title','template_id','product_id','created_by'
    ];

    public function created_at() {
        return date("d/m/Y", strtotime($this->created_at));
    }

    public function updated_at() {
        return date("d/m/Y", strtotime($this->updated_at));
    }
    public function head() {
        return $this->hasOne('\App\Head', 'page_id');
    }

    public function menu() {
        return $this->hasOne('\App\Menu', 'page_id');
    }

    public function body() {
        return $this->hasOne('\App\Body', 'page_id');
    }
    public function template() {
        return $this->hasOne('\App\Template', 'page_id');
    }
    public function footer() {
        return $this->hasOne('\App\Footer', 'page_id');
    }
    public function product() {
        return $this->belongsTo('\App\Product', 'product_id');
    }


}
