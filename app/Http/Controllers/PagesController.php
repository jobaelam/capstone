<?php

namespace App\Http\Controllers;

use App\DepartmentAccreditation;
use App\User;
use App\Agency;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function ShowDepartment($id){
        $data = [
            'department_accreditation_list' => DepartmentAccreditation::where('agency_id',$id)->get(),
            //'faculty' => User::where('role_id', 2)->get(),
        ];

        return view('pages.department')->with($data);
    }
}
