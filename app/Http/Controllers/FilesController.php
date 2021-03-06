<?php

namespace App\Http\Controllers;

use App\File;
use App\FileFlag;
use App\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
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

    public function requestFile(Request $request)
    {
        //return $request->parameter;
        $request_file = new FileFlag;
        $request_file->file_id = $request->file;
        $request_file->user = $request->user;
        $request_file->flag = 2;
        $request_file->save();
        return $request_file;
    }

    public function requestFileApprove(Request $request)
    {
        //return $request->id;
        //return ParameterFlag::find(7);
        $request_file = FileFlag::find($request->id);
        $request_file->flag = 1;
        $request_file->save();
    }

    public function requestFileDecline(Request $request)
    {
       FileFlag::destroy($request->id);
    }

    public function openFile($id)
    {
        return "<script>window.location.href = 'http://docs.google.com/gview?url=https://accreditationrepository.xyz/storage/files/".File::find($id)->name."&embedded=true/';</script>";
        // return Storage::disk('public')->download('/storage/files/', File::find($id)->name);
        // return response()->file('storage/files/'.File::find($id)->name, ['Content-Type' => 'application/pdf']);
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
            'folder_id' => $id,
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
                from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
                where users.id != " . Auth::id() . " 
                group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];
        return view('accreditation.file_upload')->with($data);
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
        if($request->hasFile('file_upload') && $request->file('file_upload')->isValid()){
            $filenameWithExt = $request->file_upload->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->file_upload->getClientOriginalExtension();  
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file_upload->storeAs('public/files/',$fileNameToStore);
        }

        $File = new File;
        $File->name = $fileNameToStore;
        $File->type = $extension;
        $File->user_id = $request->user_id;
        $File->note = $request->file_note;
        $File->folder_id = $request->folder_id;
        $File->save();

        $data = [
            'file_list' => File::where('folder_id', $File->folder_id)->get(),
            'folder' => Folder::find($File->folder_id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
                from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
                where users.id != " . Auth::id() . " 
                group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.file_index')->with($data);;
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
        $request_files = FileFlag::where('user', Auth::user()->id)->distinct()->get('file_id');
        if(count($request_files) > 0){
            foreach($request_files as $file){
                $request_file[] = $file->file_id; 
            };
        }else{
           $request_file = array();
        }

        $data = [
            'file_list' => File::where('folder_id', $id)->get(),
            'folder' => Folder::find($id),
            'request_file' => $request_file,
            'flags' => FileFlag::where('user', Auth::user()->id)->get(),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
                from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
                where users.id != " . Auth::id() . " 
                group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.file_index')->with($data);
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
            'file' => File::find($id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
                from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
                where users.id != " . Auth::id() . " 
                group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.file_edit')->with($data);
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
            'file_note' => 'required',
        ]);

        $file = File::find($id);
        $file->note = $request->file_note;
        $file->save();

        $data = [
            'file_list' => File::where('folder_id', $file->folder_id)->get(),
            'folder' => Folder::find($file->folder_id),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
                from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
                where users.id != " . Auth::id() . " 
                group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('accreditation.file_index')->with($data);
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
        $folder_id = File::find($id)->folder_id;
        
        File::find($id)->delete();

        return redirect('accreditation/file/'.$folder_id.'');
    }
}
