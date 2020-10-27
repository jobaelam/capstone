<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentAccreditation extends Model
{
    //
    public function hasDepartment(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function hasUser(){
        return $this->belongsTo(User::class, 'accreditation_head', 'id');
    }

    public function hasAgency(){
    	return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }
}
