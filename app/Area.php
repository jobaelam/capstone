<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    public function hasUser(){
        return $this->hasOne(User::class, 'head', 'id');
    }

    public function hasDepartmentAccreditation(){
        return $this->belongsTo(DepartmentAccreditation::class, 'department_accreditation_id', 'id');
    }
}
