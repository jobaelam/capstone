<?php

namespace App\Http\Controllers;

use App\Agency;
use App\DepartmentAccreditation;
use App\Area;
use App\Parameter;
use App\Benchmark;
use App\Folder;
use App\File;
use App\Department;
use App\FileFlag;
use App\BenchmarkList;
use App\ParameterFlag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'faculty_list' => User::where('office_department_id', $department_accreditation->department_id)->get(),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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

        $area = new Area;
        $area->name = $request->area_name;
        $area->description = $request->area_description;
        $area->department_accreditation_id = $request->department_accreditation_id;
        //$area->head = $request->area_head;
        $area->save();

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
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
            'faculty_list' => User::where('office_department_id', $area->hasDepartmentAccreditation->department_id)->get(),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
        
        $parameter_list = Parameter::where('area_id', $id)->get();
        foreach($parameter_list as $parameter){
            $parameter_flag_list = ParameterFlag::where('parameter_id', $parameter->id)->get();
            foreach($parameter_flag_list as $parameter_flag){
                $parameter_flag->delete();
            }
            $benchmark_list = Benchmark::where('parameter_id', $parameter->id)->get();
            foreach($benchmark_list as $benchmark){
                $folder_list = Folder::where('benchmark_id', $benchmark->id)->get();
                foreach($folder_list as $folder){
                    $file_list = File::where('folder_id', $folder->id)->get();
                    foreach($file_list as $file){
                        $file->delete();
                    }
                    $folder->delete();
                }
                $benchmark->delete();
            }
            $parameter->delete();
        }

        $department_accreditation_id = Area::find($id)->department_accreditation_id;
        
        Area::find($id)->delete();

        return redirect('accreditation/area/'.$department_accreditation_id.'');
    }
}
