<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Area;
use App\User;
use App\DepartmentAccreditation;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $department_accreditation = DepartmentAccreditation::find($id);

        $data = [
            'department_accreditation_id' => $department_accreditation->id,
            'faculty_list' => User::where('office_department_id', $department_accreditation->department_id)
        ];
        return view('accreditation.area_create')->with($data);
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
            'area_name' => 'required',
            'area_description' => 'required'
        ]);

        $department_accreditation_list = DepartmentAccreditation::all();

        foreach($department_accreditation_list as $department_accreditation){
            $area = new Area;
            $area->name = $request->area_name;
            $area->description = $request->area_description;
            $area->department_accreditation_id = $department_accreditation->id;
            $area->head = $request->area_head;
            $area->save();
        }
        $id = $request->department_accreditation_id;

        return redirect('accreditation/area/'.$id.'');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = [
            'area_list' => Area::where('department_accreditation_id', $id)->get(),
            'department_accreditation' => DepartmentAccreditation::find($id),
        ];

        return view('accreditation.area_index')->with($data);
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
        $area = Area::find($id);
        $data = [
            'area' => $area,
            'faculty_list' => User::where('office_department_id', $area->hasDepartmentAccreditation->department_id),
        ];

        return view('accreditation.area_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
        $this->validate($request,[
            'area_name' => 'required',
            'area_description' => 'required'
        ]);

        $area->name = $request->area_name;
        $area->description = $request->area_description;
        $area->head = $request->area_head;
        $area->save();

        $data = [
            'area_list' => Area::where('department_accreditation_id', $area->department_accreditation_id)->get(),
            'department_accreditation' => DepartmentAccreditation::find($area->department_accreditation_id),
        ];

        return view('accreditation.area_index')->with($data);
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
