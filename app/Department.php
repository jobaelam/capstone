<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function chairperson(){
        return $this->hasOne(User::class, 'office_department_id', "id");
    }
}
