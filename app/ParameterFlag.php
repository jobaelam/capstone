<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterFlag extends Model
{
    //
    public function hasUser(){
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function hasParameter(){
        return $this->belongsTo(Parameter::class, 'parameter_id', 'id');
    }
}
