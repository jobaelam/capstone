<?php

namespace App\Http\Controllers;

use App\Benchmark;
use App\Folder;
use Illuminate\Http\Request;

class FoldersController extends Controller
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
            'benchmark_id' => $id,
        ];
        return view('accreditation.folder_create')->with($data);
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
            'folder_name' => 'required',
            'folder_note' => 'required'
        ]);

        $folder = new Folder;
        $folder->name = $request->folder_name;
        $folder->note = $request->folder_note;
        $folder->benchmark_id = $request->benchmark_id;
        $folder->save();
        $id = $request->input('benchmark_id');

        return redirect('/accreditation/folder/'.$id.'');
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
            'folder_list' => Folder::where('benchmark_id', $id)->get(),
            'benchmark' => Benchmark::find($id),
        ];

        return view('accreditation.folder_index')->with($data);
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
            'folder' => Folder::find($id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];
        return view('accreditation.folder_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
        $this->validate($request,[
            'folder_name' => 'required',
            'folder_note' => 'required'
        ]);

        $folder->name = $request->folder_name;
        $folder->note = $request->folder_note;
        $folder->save();

        $data = [
            'folder_list' => Folder::where('benchmark_id', $folder->benchmark_id)->get(),
            'benchmark' => Benchmark::find($folder->benchmark_id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.folder_index')->with($data);
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
