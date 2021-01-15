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
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
            'agency' => Agency::find($id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
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
        $department_list = DepartmentAccreditation::where('agency_id', $id)->get();
        foreach($department_list as $department){
            $area_list = Area::where('department_accreditation_id', $department->id)->get();
            foreach($area_list as $area){
                $parameter_list = Parameter::where('area_id', $area->id)->get();
                $parameter_flag_list = ParameterFlag::where('parameter_id', $parameter->id)->get();
                foreach($parameter_flag_list as $parameter_flag){
                    $parameter_flag->delete();
                }
                foreach($parameter_list as $parameter){
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
                $area->delete();
            }
            $department->delete();
        }

        Agency::find($id)->delete();

        return redirect('accreditation');
    }
}
