<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateAttribute extends Model
{
    protected $table = 'template_attribute';
    protected $fillable = ['name','value','attribute_id'];

    public function attribute() {
        return $this->belongsTo('\App\Attribute', 'attribute_id');
    }
}
