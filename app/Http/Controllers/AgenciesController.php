<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Department;
use App\DepartmentAccreditation;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'agencies_list' => Agency::all(),
        ];

        return view('accreditation.agency_index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'department_id' => Department::all(),
        ];
        return view('accreditation.agency_create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'agency_name' => 'required',
            'agency_description' => 'required'
        ]);

        $agency = new Agency;
        $agency->name = $request->agency_name;
        $agency->description = $request->agency_description;
        $agency->save();

        $department_list = Department::all();

        foreach($department_list as $department){
            $department_accreditation = new DepartmentAccreditation;
            $department_accreditation->department_id = $department->id;
            $department_accreditation->agency_id = $agency->id;
            $department_accreditation->save();
        }

        return redirect('accreditation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = [
            'agency' => Agency::find($id)
        ];

        return view('accreditation.agency_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'agency_name' => 'required',
            'agency_description' => 'required'
        ]);

        $agency = Agency::find($id);
        $agency->name = $request->agency_name;
        $agency->description = $request->agency_description;
        $agency->save();

        return redirect('accreditation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
