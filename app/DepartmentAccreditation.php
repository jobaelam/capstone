<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentAccreditation extends Model
{
    //
    public function hasDepartment(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
