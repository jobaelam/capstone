<?php

namespace App\Http\Controllers;

use App\Parameter;
use App\Area;
use App\BenchmarkList;
use App\Benchmark;
use Illuminate\Http\Request;

class ParametersController extends Controller
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
        $data = [
            'area_id' => $id,
        ];
        return view('accreditation.parameter_create')->with($data);
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
            'parameter_name' => 'required',
            'parameter_description' => 'required'
        ]);

        $area_list = Area::all();
        $benchmark_list = BenchmarkList::all();

        foreach($area_list as $area){
            $parameter = new Parameter;
            $parameter->name = $request->parameter_name;
            $parameter->description = $request->parameter_description;
            $parameter->area_id = $area->id;
            $parameter->save();
            foreach($benchmark_list as $benchmark_name){
                $benchmark = new Benchmark;
                $benchmark->benchmark_name_id = $benchmark_name->id;
                $benchmark->parameter_id = $parameter->id;
                $benchmark->save();
            }
        }


        //Parameter Total Status
        $total_benchmark_status = null;
        $benchmark_list = Benchmark::where('parameter_id', $parameter->id)->get();
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

        $id = $request->area_id;

        return redirect('/accreditation/parameter/'.$id.'');
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
            'parameter_list' => Parameter::where('area_id', $id)->get(),
            'area' => Area::find($id),
        ];

        return view('accreditation.parameter_index')->with($data);
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
            'parameter' => Parameter::find($id),
        ];
        return view('accreditation.parameter_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        //
        $this->validate($request,[
            'parameter_name' => 'required',
            'parameter_description' => 'required'
        ]);

        $parameter->name = $request->parameter_name;
        $parameter->description = $request->parameter_description;
        $parameter->save();

        $data = [
            'parameter_list' => Parameter::where('area_id', $parameter->area_id)->get(),
            'area' => Area::find($parameter->area_id),
        ];

        return view('accreditation.parameter_index')->with($data);
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
