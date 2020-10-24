<?php

namespace App\Http\Controllers;

use App\Benchmark;
use App\Parameter;
use App\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BenchmarksController extends Controller
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
    public function create()
    {
        //
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
            'benchmark_list' => Benchmark::where('parameter_id', $id)->get(),
            'parameter' => Parameter::find($id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.benchmark_index')->with($data);
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
            'benchmark' => Benchmark::find($id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.benchmark_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Benchmark $benchmark)
    {
        //
        $this->validate($request,[
            'benchmark_status' => 'required',
        ]);

        $benchmark->status = $request->benchmark_status/100;
        $benchmark->save();

        //Parameter Total Status
        $total_benchmark_status = null;
        $benchmark_list = Benchmark::where('parameter_id', $benchmark->parameter_id)->get();
        foreach($benchmark_list as $bench){
            $total_benchmark_status = $total_benchmark_status + $bench->status;
        }
        $parameter_status = Parameter::find($benchmark->parameter_id);
        $parameter_status->status = $total_benchmark_status/(count($benchmark_list));
        $parameter_status->save();

        //AccessArea Total Status
        $total_parameter_status = null;
        $parameter_list = Parameter::where('area_id', $parameter_status->area_id)->get();
        foreach($parameter_list as $parameter){
            $total_parameter_status = $total_parameter_status + $parameter->status;
        } 
        $area_status = Area::find($parameter_status->area_id);
        $area_status->status = $total_parameter_status/(count($parameter_list));
        $area_status->save();

        // //Department Total Status
        // $totalDepartmentStatus = null;
        // $AccessAreas = AccessArea::where('departmentId',$AccessStatus->departmentId)->get();
        // foreach($AccessAreas as $Access){
        //     $totalDepartmentStatus = $totalDepartmentStatus + $Access->status;
        // } 
        // $DepartmentStatus = Department::find($AccessStatus->departmentId);
        // $DepartmentStatus->status = $totalDepartmentStatus/(count($AccessAreas));
        // $DepartmentStatus->save();

        $data = [
            'benchmark_list' => Benchmark::where('parameter_id', $benchmark->parameter_id)->get(),
            'parameter' => Parameter::find($benchmark->parameter_id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.benchmark_index')->with($data);
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
