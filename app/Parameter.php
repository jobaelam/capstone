<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    //Parameter to area
    public function hasArea(){
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
